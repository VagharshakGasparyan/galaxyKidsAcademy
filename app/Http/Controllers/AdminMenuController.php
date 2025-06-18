<?php

namespace App\Http\Controllers;

use App\Models\MainMenu;
use App\Models\Page;
use App\Models\Photo;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminMenuController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $menu = MainMenu::whereNull('parent_id')->orderBy('order', 'asc')->get();
        return view('admin.menu.menu', compact('menu'));
    }
    public function create(){
        $pages = Page::where('enabled', true)->get();
        return view('admin.menu.create_menu', compact('pages'));
    }
    public function postCreate(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:255',
            'page_id' => 'nullable|exists:pages,id',
        ]);
        $link = $request->get('link');
        $page_id = $request->get('page_id');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $name = [];
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            $name[$localeCode] = '';
        }
        $name[$lang] = $request->get('name') ?? '';

        MainMenu::create([
            'name' => $name,
            'link' => $link,
            'page_id' => $page_id,
        ]);

        return redirect()->route('admin.main_menu');
    }
    public function update(Request $request, $id){
        $pages = Page::where('enabled', true)->get();
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $menuItem = MainMenu::findOrFail($id);
        return view('admin.menu.update_menu', compact('menuItem', 'lang', 'pages'));
    }
    public function postUpdate(Request $request, $id){
        $main_menu = MainMenu::findOrFail($id);
        $request->validate([
            'name' => 'required|min:1|max:255',
            'page_id' => 'nullable|exists:pages,id',
        ]);
        $link = $request->get('link');
        $page_id = $request->get('page_id');
        $lang = $request->get('lang') ?? app()->getLocale();
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $name = $main_menu->name ?? [];
        $name[$lang] = $request->get('name') ?? '';

        $main_menu->update([
            'name' => $name,
            'link' => $link,
            'page_id' => $page_id,
        ]);

        return back();

    }


    public function delete($id){
        if(MainMenu::where('id', $id)->exists()){
            MainMenu::find($id)->delete();
        }

        return back();
    }
}
