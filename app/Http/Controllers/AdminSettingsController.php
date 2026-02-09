<?php

namespace App\Http\Controllers;

use App\Models\MyConfig;
use App\Services\FService;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $settings = [];
        $settings['icon'] = MyConfig::where('group_key', 'site')->where('key', 'icon')->first();
        $settings['header_logo'] = MyConfig::where('group_key', 'site')->where('key', 'header_logo')->first();
        $settings['home_top_image'] = MyConfig::where('group_key', 'site')->where('key', 'home_top_image')->first();
        $settings['home_middle_image'] = MyConfig::where('group_key', 'site')->where('key', 'home_middle_image')->first();
        $settings['home_bottom_image'] = MyConfig::where('group_key', 'site')->where('key', 'home_bottom_image')->first();
        $settings['top_section_image'] = MyConfig::where('group_key', 'site')->where('key', 'top_section_image')->first();
        $settings['pdf1'] = MyConfig::where('group_key', 'site')->where('key', 'pdf1')->first();
        $settings['pdf2'] = MyConfig::where('group_key', 'site')->where('key', 'pdf2')->first();
        $settings['instagram_link'] = MyConfig::where('group_key', 'site')->where('key', 'instagram_link')->first();
        $settings['facebook_link'] = MyConfig::where('group_key', 'site')->where('key', 'facebook_link')->first();
        $settings['map'] = MyConfig::where('group_key', 'site')->where('key', 'map')->first();

        return view('admin.setting.settings', compact('settings'));
    }

    public function postUpdate(Request $request)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:150|dimensions:min_width=16,min_height=16,max_width=512,max_height=512',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:15000|dimensions:min_width=32,min_height=32,max_width=1920,max_height=1920',
            'home_top_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15000|dimensions:min_width=32,min_height=32,max_width=3000,max_height=3000',
            'home_middle_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15000|dimensions:min_width=32,min_height=32,max_width=3000,max_height=3000',
            'home_bottom_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15000|dimensions:min_width=32,min_height=32,max_width=3000,max_height=3000',
            'top_section_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15000|dimensions:min_width=32,min_height=32,max_width=3000,max_height=3000',
            'pdf1' => 'nullable|file|mimes:pdf|max:100000',
            'pdf2' => 'nullable|file|mimes:pdf|max:100000',
            'map_latitude' => 'required|numeric',
            'map_longitude' => 'required|numeric',
            'map_zoom' => 'required|numeric',
        ]);

        $settings = ['icon', 'header_logo', 'home_top_image', 'home_middle_image', 'home_bottom_image', 'top_section_image'];
        foreach ($settings as $setting) {
            $old_setting = $request->get('old_' . $setting);
            $db_setting = MyConfig::where('group_key', 'site')->where('key', $setting)->first()->value1 ?? null;
            $new_setting = $old_setting ? $db_setting : null;
            $req_setting = $request->files->get($setting);
            if($req_setting){
                $src_filePath = (new FService())->fileUpload($req_setting, 'uploads');
                $new_setting = $src_filePath['filePath'];
                if($db_setting){
                    Storage::disk('public')->delete($db_setting);
                }
            }elseif (!$old_setting && $db_setting) {
                Storage::disk('public')->delete($db_setting);
            }
            MyConfig::updateOrCreate(
                ['group_key' => 'site', 'key' => $setting],
                [
                    'group_key' => 'site',
                    'key' => $setting,
                    'value1' => $new_setting
                ]
            );
        }
        $pdfs = ['pdf1', 'pdf2'];
        foreach ($pdfs as $pdf) {
            $old_pdf = $request->get('old_' . $pdf);
            $db_pdf = MyConfig::where('group_key', 'site')->where('key', $pdf)->first()->value1 ?? null;
            $new_pdf = $old_pdf ? $db_pdf : null;
            $req_pdf = $request->files->get($pdf);
            if($req_pdf){
                $src_filePath = (new FService())->fileUpload($req_pdf, 'uploads/pdf');
                $new_pdf = $src_filePath['filePath'];
                if($db_pdf){
                    Storage::disk('public')->delete($db_pdf);
                }
            }elseif (!$old_pdf && $db_pdf) {
                Storage::disk('public')->delete($db_pdf);
            }
            MyConfig::updateOrCreate(
                ['group_key' => 'site', 'key' => $pdf],
                [
                    'group_key' => 'site',
                    'key' => $pdf,
                    'value1' => $new_pdf
                ]
            );
        }
        //-----------instagram and facebook links---------------------------
        $socialLinks = ['instagram_link', 'facebook_link'];
        foreach ($socialLinks as $link) {
            $social_link = $request->get($link);
            if($social_link){
                MyConfig::updateOrCreate(
                    ['group_key' => 'site', 'key' => $link],
                    [
                        'group_key' => 'site',
                        'key' => $link,
                        'value1' => $social_link
                    ]
                );
            }else{
                MyConfig::where('group_key', 'site')->where('key', $link)->delete();
            }
        }
        //---------map--------------------------------
        $map_latitude = $request->get('map_latitude');
        $map_longitude = $request->get('map_longitude');
        $map_zoom = $request->get('map_zoom');
        if($map_latitude && $map_longitude && $map_zoom){
            MyConfig::updateOrCreate(
                ['group_key' => 'site', 'key' => 'map'],
                [
                    'group_key' => 'site',
                    'key' => 'map',
                    'value1' => $map_latitude,
                    'value2' => $map_longitude,
                    'value3' => $map_zoom,
                ]
            );
        }

        return back();
    }

    public function logs(Request $request)
    {

//        $page = $request->get('page') ?? 1;
        $per_page = $request->get('per_page') ?? 10;
//        $path = storage_path('logs');
//        $fileNames = array_diff(scandir($path), ['.', '..']);
//        $logs = array_filter($fileNames, function($file) use ($path) {
//            return is_file($path.'/'.$file) && str_ends_with($file, '.log');
//        });
//        usort($logs, function ($a, $b) {
//            $dateA = strtotime(str_replace(['laravel-', '.log'], '', $a));
//            $dateB = strtotime(str_replace(['laravel-', '.log'], '', $b));
//            return $dateB <=> $dateA;
//        });

        $logs = collect(File::allFiles(base_path('storage/logs')))
            ->filter(fn($file) => str_starts_with(basename($file), 'laravel-') && str_ends_with(basename($file), '.log'))
            ->sortDesc()
            ->paginate(10);
//        dd($logs);

        return view('admin.setting.logs', compact('per_page', 'logs'));
    }

    public function logsShow($name)
    {
//        Log::debug('***---===|||===---***');
        $path = base_path('storage/logs/' . $name);
        try {
            $log = File::get($path);
        }catch (\Exception $exception){
            abort(404);
        }

        $size = File::size($path);
        $arrLog = preg_split('/(?=\[(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})\])/', $log, -1, PREG_SPLIT_NO_EMPTY);
        $arrLog = array_reverse($arrLog);

        return view('admin.setting.show_log', compact('name', 'log', 'size', 'arrLog'));
    }
    public function logsDelete($name)
    {
        $path = base_path('storage/logs/' . $name);
        try {
            File::delete($path);
        }catch (\Exception $exception){

        }
        return back();
    }
}
