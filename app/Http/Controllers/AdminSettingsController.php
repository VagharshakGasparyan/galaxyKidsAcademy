<?php

namespace App\Http\Controllers;

use App\Models\MyConfig;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $settings = [];
        $settings['icon'] = MyConfig::where('group_key', 'site')->where('key', 'icon')->first();
        $settings['header_logo'] = MyConfig::where('group_key', 'site')->where('key', 'header_logo')->first();

        return view('admin.setting.settings', compact('settings'));
    }

    public function postUpdate(Request $request)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:150|dimensions:min_width=16,min_height=16,max_width=512,max_height=512',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=32,min_height=32,max_width=1920,max_height=1920',

        ]);
        //--------------icon
        $old_icon = $request->get('old_icon');
        $db_icon = MyConfig::where('group_key', 'site')->where('key', 'icon')->first()->value1 ?? null;
        $new_icon = $old_icon ? $db_icon : null;
        $icon = $request->files->get('icon');
        if($icon){
            $src_filePath = (new FService())->fileUpload($icon, 'uploads');
            $new_icon = $src_filePath['filePath'];
            if($db_icon){
                Storage::disk('public')->delete($db_icon);
            }
        }elseif (!$old_icon && $db_icon) {
            Storage::disk('public')->delete($db_icon);
        }
        MyConfig::updateOrCreate(
            ['group_key' => 'site', 'key' => 'icon'],
            [
                'group_key' => 'site',
                'key' => 'icon',
                'value1' => $new_icon
            ]
        );
        //--------------header_logo
        $old_header_logo = $request->get('old_header_logo');
        $db_header_logo = MyConfig::where('group_key', 'site')->where('key', 'header_logo')->first()->value1 ?? null;
        $new_header_logo = $old_header_logo ? $db_header_logo : null;
        $header_logo = $request->files->get('header_logo');
        if($header_logo){
            $src_filePath = (new FService())->fileUpload($header_logo, 'uploads');
            $new_header_logo = $src_filePath['filePath'];
            if($db_header_logo){
                Storage::disk('public')->delete($db_header_logo);
            }
        }elseif (!$old_header_logo && $db_header_logo) {
            Storage::disk('public')->delete($db_header_logo);
        }
        MyConfig::updateOrCreate(
            ['group_key' => 'site', 'key' => 'header_logo'],
            [
                'group_key' => 'site',
                'key' => 'header_logo',
                'value1' => $new_header_logo
            ]
        );

        return back();
    }
}
