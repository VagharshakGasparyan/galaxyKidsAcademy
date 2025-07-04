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
            ->paginate(15);
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
