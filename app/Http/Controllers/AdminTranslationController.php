<?php

namespace App\Http\Controllers;

use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminTranslationController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang') ?? app()->getLocale();
        $req_key = $request->get('key');
        $req_val = $request->get('val');
        if (!app('laravellocalization')->checkLocaleInSupportedLocales($lang)) {
            $lang = app()->getLocale();
        }
        $path = base_path('lang/' . $lang . '.json');
        $existFile = File::exists($path);
        if (!$existFile){
            if(File::exists(base_path('lang/base_keys.json'))){
                $baseTr = file_get_contents($path);
                file_put_contents($path, $baseTr);
            }else{
                $tr_keys = (new FService())->findTranslationKeysInCode();
                if(count($tr_keys)){
                    $arr = [];
                    foreach($tr_keys as $key){
                        $arr[$key] = "";
                    }
                    file_put_contents(base_path('lang/base_keys.json'), json_encode($arr, JSON_UNESCAPED_UNICODE));
                    file_put_contents($path, json_encode($arr, JSON_UNESCAPED_UNICODE));
                }else{
                    file_put_contents(base_path('lang/base_keys.json'), "{}");
                    file_put_contents($path, "{}");
                }
            }
        }
        $translations = file_get_contents($path);
        $translations = json_decode($translations, true);
        if($req_key && !$req_val){
            $newTr = [];
            foreach($translations as $key => $value){
                if (str_contains(strtolower($key) , strtolower($req_key))) {
                    $newTr[$key] = $value;
                }
            }
            $translations = $newTr;
        }
        if($req_val && !$req_key){
            $newTr = [];
            foreach($translations as $key => $value){
                if (str_contains(strtolower($value), strtolower($req_val))) {
                    $newTr[$key] = $value;
                }
            }
            $translations = $newTr;
        }
        if($req_val && $req_key){
            $newTr = [];
            foreach($translations as $key => $value){
                if (str_contains(strtolower($key) , strtolower($req_key)) && str_contains(strtolower($value), strtolower($req_val))) {
                    $newTr[$key] = $value;
                }
            }
            $translations = $newTr;
        }

        return view('admin.translation.translations', compact('lang', 'translations', 'req_key', 'req_val'));
    }

    public function save(Request $request)
    {
        $key = $request->get('key');
        $val = $request->get('val') ?? '';
        $lang = $request->get('lang');
        if(!$key || !$lang){
            return response(['key' => 'required', 'lang' => 'required'], 426);
        }
        $path = base_path('lang/' . $lang . '.json');
        $existFile = File::exists($path);
        if(!$existFile){
            return response(['file' => 'Translation file not exist.'], 426);
        }
        $tr_content = file_get_contents($path);
        $translations = json_decode($tr_content, true);
        $translations[$key] = $val;
        file_put_contents($path, json_encode($translations, JSON_UNESCAPED_UNICODE));

        return response(['ok' => true], 200);
    }

    public function bulkSave(Request $request)
    {
        $data = $request->get('data');
        $lang = $request->get('lang');
        if(!$data || !$lang){
            return response(['data' => 'required', 'lang' => 'required'], 426);
        }
        $path = base_path('lang/' . $lang . '.json');
        $existFile = File::exists($path);
        if(!$existFile){
            return response(['file' => 'Translation file not exist.'], 426);
        }
        $tr_content = file_get_contents($path);
        $translations = json_decode($tr_content, true);
        $arrData = json_decode($data, true);
        foreach ($arrData as $key => $value){
            if(array_key_exists($key, $translations)){
                $translations[$key] = $value;
            }
        }
        file_put_contents($path, json_encode($translations, JSON_UNESCAPED_UNICODE));

        return response(['ok' => true], 200);
    }

    public function putKeys()
    {
        (new FService())->addTranslations();
        return back();
    }

}
