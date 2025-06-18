<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminPageController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $items = Page::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.page.pages', compact('items'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {

        return view('admin.page.create_page');
    }

    public function postCreate(Request $request): \Illuminate\Http\RedirectResponse
    {
//        dd($request->all());
        request()->validate([
            'slug' => 'required|max:255|unique:pages,slug',
            'name' => 'required|max:255',
            'big_title' => 'nullable|min:1|max:10000',
            'medium_title' => 'nullable|min:1|max:10000',
            'small_title' => 'nullable|min:1|max:10000',
            'content' => 'nullable|min:1|max:1000000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
            'images' => 'nullable|array|min:1|max:50',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
        ]);
        $enabled = $request->has('enabled');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $type = $request->get('type') ?? 'page';
        $big_title = [];
        $medium_title = [];
        $small_title = [];
        $content = [];
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            $big_title[$localeCode] = '';
            $medium_title[$localeCode] = '';
            $small_title[$localeCode] = '';
            $content[$localeCode] = '';
        }
        $big_title[$lang] = $request->get('big_title') ?? '';
        $medium_title[$lang] = $request->get('medium_title') ?? '';
        $small_title[$lang] = $request->get('small_title') ?? '';
        $content[$lang] = $request->get('content') ?? '';

        $images = [];
        foreach ($request->files->get('images') ?? [] as $image) {
            $src_filePath = (new FService())->fileUpload($image, 'page_images');
            $filePath = $src_filePath['filePath'];
            $images[] = $filePath;
        }
        $image = null;
        if($request->files->get('image')){
            $src_filePath = (new FService())->fileUpload($request->files->get('image'), 'page_images');
            $filePath = $src_filePath['filePath'];
            $image = $filePath;
        }

        Page::create([
            'enabled' => $enabled,
            'type' => $type,
            'image' => $image,
            'images' => $images,
            'name' => $request->get('name'),
            'big_title' => $big_title,
            'medium_title' => $medium_title,
            'small_title' => $small_title,
            'content' => $content,
            'slug' => $request->get('slug')
        ]);

        return redirect()->route('admin.pages');
    }

    public function update(Request $request, $id): \Illuminate\Contracts\View\View
    {
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }

        $page = Page::findOrFail($id);
        return view('admin.page.update_page', compact('page', 'lang'));
    }

    public function postUpdate(Request $request, $id)
    {
//        dd($request->all());
        $page = Page::findOrFail($id);
        request()->validate([
            'slug' => 'required|max:255|unique:pages,slug,' . $id,
            'name' => 'required|max:255',
            'big_title' => 'nullable|min:1|max:10000',
            'medium_title' => 'nullable|min:1|max:10000',
            'small_title' => 'nullable|min:1|max:10000',
            'content' => 'nullable|min:1|max:1000000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
            'images' => 'nullable|array|min:1|max:50',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',

        ]);
        $enabled = $request->has('enabled');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $type = $request->get('type') ?? 'page';
        $big_title = $page->big_title ?? [];
        $medium_title = $page->medium_title ?? [];
        $small_title = $page->small_title ?? [];
        $content = $page->content ?? [];
        $big_title[$lang] = $request->get('big_title') ?? '';
        $medium_title[$lang] = $request->get('medium_title') ?? '';
        $small_title[$lang] = $request->get('small_title') ?? '';
        $content[$lang] = $request->get('content') ?? '';

        $images = [];
        foreach ($request->files->get('images') ?? [] as $image) {
            $src_filePath = (new FService())->fileUpload($image, 'page_images');
            $filePath = $src_filePath['filePath'];
            $images[] = $filePath;
        }
        $old_images_checked = $request->get('old_images_checked') ?? [];
        foreach ($request->get('old_images') ?? [] as $indexImage => $imageItem) {
            if (array_key_exists($indexImage, $old_images_checked)) {
                $images[] = $imageItem;
            }
        }
//        dd($images);
        $image = null;
        if($request->files->get('image')){
            $src_filePath = (new FService())->fileUpload($request->files->get('image'), 'page_images');
            $filePath = $src_filePath['filePath'];
            $image = $filePath;
        }elseif ($request->has('old_image')){
            $image = $page->image;
        }elseif($page->image){
            Storage::disk('public')->delete($page->image);
        }

        $page->update([
            'enabled' => $enabled,
            'type' => $type,
            'image' => $image,
            'images' => $images,
            'name' => $request->get('name'),
            'big_title' => $big_title,
            'medium_title' => $medium_title,
            'small_title' => $small_title,
            'content' => $content,
            'slug' => $request->get('slug')
        ]);

        return back();
    }

    public function show($id): \Illuminate\Contracts\View\View
    {

        return view('admin.page.show_page');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        /**
         * hint
         * Page::where('id', $id)->delete() not working for delete files
         * use age::find($id)->delete();
         */
        if(Page::where('id', $id)->exists()){
            Page::find($id)->delete();
        }

        return back();
    }
}
