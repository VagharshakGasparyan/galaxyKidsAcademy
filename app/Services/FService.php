<?php


namespace App\Services;


use App\Models\AgeCategory;
use App\Models\Club;
use App\Models\ClubTable;
use App\Models\Game;
use App\Models\Group;
use App\Models\GroupType;
use App\Models\Snipers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FService
{

    public function isJson($string): bool
    {
        return is_string($string) &&
            (is_object(json_decode($string)) ||
                is_array(json_decode($string)));
    }

    public function fileUpload($file, $path = 'uploads', $filename = null): array
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $filename
            ? $filename
            : md5($file->getClientOriginalName() . random_int(1, 9999) . time()) . '.' . $extension;
        Storage::disk('public')->put($path . '/' . $filename, $file->getContent());
        return ['src' => config('app.url').'/storage/'.$path.'/'.$filename, 'filePath' => $path . '/' . $filename];
    }

    public function findTranslationKeysInCode()
    {
        $paths = [
            app_path(),
            resource_path('views'),
        ];

        $pattern = '/__\([\'"](.+?)[\'"]\)/';
        $keys = [];
        foreach ($paths as $path) {
            $files = File::allFiles($path);
            foreach ($files as $file) {
                $contents = File::get($file);

                if (preg_match_all($pattern, $contents, $matches)) {
                    $keys = array_merge($keys, $matches[1]);
                }
            }
        }

        return array_unique($keys);
    }

    public function addTranslations()
    {
        $tr_keys = $this->findTranslationKeysInCode();
        $arr = [];
        if(count($tr_keys)){
            foreach($tr_keys as $key){
                $arr[$key] = "";
            }
            file_put_contents(base_path('lang/base_keys.json'), json_encode($arr, JSON_UNESCAPED_UNICODE));
        }else{
            file_put_contents(base_path('lang/base_keys.json'), "{}");
        }
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $path = base_path('lang/' . $localeCode . '.json');
            $existFile = File::exists($path);
            if (!$existFile){
                $str = count($arr) ? json_encode($arr, JSON_UNESCAPED_UNICODE) : "{}";
                file_put_contents($path, $str);
            }else{
                $str_tr = file_get_contents($path);
                $arr_tr = json_decode($str_tr, true);
                foreach ($arr_tr as $key => $value){
                    if(array_key_exists($key, $arr)){
                        $arr[$key] = $value;
                    }
                }
                file_put_contents($path, json_encode($arr, JSON_UNESCAPED_UNICODE));
            }
        }
    }

    public function setLocale(): string
    {
        $currentLocale = LaravelLocalization::setLocale();

//        dump($currentLocale);
//        dd($currentLocale);
        if($currentLocale) {
            app()->setLocale($currentLocale);
        }

//        dd(LaravelLocalization::setLocale());
        return '{locale?}';
    }


}
