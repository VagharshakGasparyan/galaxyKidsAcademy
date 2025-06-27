<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Photo;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminPhotoController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $filter_title = $request->query('title');
        $filter_description = $request->query('description');
        $filter_enabled = $request->query('enabled');


        $photos = Photo::when($filter_enabled !== null, function ($query) use ($filter_enabled) {
            return $query->where('enabled', $filter_enabled);
        })->when($filter_title, function ($query) use ($filter_title) {
//            return $query->where('title', 'like', '%' . $filter_title . '%');
            return $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($filter_title) . '%']);
        })->when($filter_description, function ($query) use ($filter_description) {
//            return $query->where('description', 'like', '%' . $filter_description . '%');
            return $query->whereRaw('LOWER(description) LIKE ?', ['%' . strtolower($filter_description) . '%']);
        })->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.photo.photos', compact('photos', 'filter_title', 'filter_description', 'filter_enabled'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {

        return view('admin.photo.create_photo');
    }

    public function postCreate(Request $request): \Illuminate\Http\RedirectResponse
    {
//        dd($request->all());
        request()->validate([
            'title' => 'nullable|min:1|max:10000',
            'description' => 'nullable|min:1|max:1000000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
        ]);
        $enabled = $request->has('enabled');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $title = [];
        $description = [];
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            $title[$localeCode] = '';
            $description[$localeCode] = '';
        }
        $title[$lang] = $request->get('title') ?? '';
        $description[$lang] = $request->get('description') ?? '';

        $src_filePath = (new FService())->fileUpload($request->files->get('image'), 'photos');
        $image = $src_filePath['filePath'];

        Photo::create([
            'enabled' => $enabled,
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);

        return redirect()->route('admin.photos');
    }

    public function update(Request $request, $id): \Illuminate\Contracts\View\View
    {
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }

        $photo = Photo::findOrFail($id);
        return view('admin.photo.update_photo', compact('photo', 'lang'));
    }

    public function postUpdate(Request $request, $id)
    {
//        dd($request->all());
        $photo = Photo::findOrFail($id);
        request()->validate([
            'title' => 'nullable|min:1|max:10000',
            'description' => 'nullable|min:1|max:1000000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=96,min_height=96,max_width=1920,max_height=1920',
        ]);
        $enabled = $request->has('enabled');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $title = $photo->title ?? [];
        $description = $photo->description ?? [];
        $title[$lang] = $request->get('title') ?? '';
        $description[$lang] = $request->get('description') ?? '';

        $image = $photo->image;
        if($request->files->get('image')){
            $src_filePath = (new FService())->fileUpload($request->files->get('image'), 'photos');
            $filePath = $src_filePath['filePath'];
            $image = $filePath;
            Storage::disk('public')->delete($photo->image);
        }

        $photo->update([
            'enabled' => $enabled,
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);

        return back();
    }

    public function show(Request $request, $id): \Illuminate\Contracts\View\View
    {
        $photo = Photo::findOrFail($id);
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        return view('admin.photo.show_photo', compact('photo', 'lang'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        /**
         * hint
         * Page::where('id', $id)->delete() not working for delete files
         * use age::find($id)->delete();
         */
        if(Photo::where('id', $id)->exists()){
            Photo::find($id)->delete();
        }

        return back();
    }
}
