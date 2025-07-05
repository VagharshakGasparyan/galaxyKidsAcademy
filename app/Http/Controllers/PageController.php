<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(): \Illuminate\Contracts\View\View
    {

        return view('home');
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
        $page = Page::where('slug', $newSlug)->firstOrFail();
        return view('page', compact('page'));
    }
}
