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
