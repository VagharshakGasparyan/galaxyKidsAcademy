<?php

namespace App\Http\Controllers;

use App\Models\MyConfig;
use App\Models\Page;
use App\Models\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(): \Illuminate\Contracts\View\View
    {
        $home_top_image = MyConfig::where('group_key', 'site')->where('key', 'home_top_image')->first();
        $home_middle_image = MyConfig::where('group_key', 'site')->where('key', 'home_middle_image')->first();
        $home_bottom_image = MyConfig::where('group_key', 'site')->where('key', 'home_bottom_image')->first();
        return view('home', compact('home_top_image', 'home_middle_image', 'home_bottom_image'));
    }
    public function gallery(): \Illuminate\Contracts\View\View
    {
        $photos = Photo::where('enabled', true)->orderBy('created_at', 'desc')->get();
        return view('gallery', compact('photos'));
    }

    public function aboutUs(): \Illuminate\Contracts\View\View
    {
        return view('about_us');
    }

    public function admissions(): \Illuminate\Contracts\View\View
    {
        return view('admissions');
    }

    public function contactUs(): \Illuminate\Contracts\View\View
    {
        return view('contact_us');
    }

    public function ourPrograms(): \Illuminate\Contracts\View\View
    {
        return view('our_programs');
    }

    public function parentsCorner(): \Illuminate\Contracts\View\View
    {
        return view('parents_corner');
    }

    public function privacyPolicy(): \Illuminate\Contracts\View\View
    {
        return view('privacy_policy');
    }

    public function tuitionsFees(): \Illuminate\Contracts\View\View
    {
        return view('tuitions_fees');
    }

    public function page($locale, $slug, $subs = null): \Illuminate\Contracts\View\View
    {
//        dd($locale, $slug, $subs);
        $newSlug = $subs ? $slug . '/' . $subs : $slug;
        $page = Page::where('slug', $newSlug)->where('enabled', true)->firstOrFail();
        return view('page', compact('page'));
    }
}
