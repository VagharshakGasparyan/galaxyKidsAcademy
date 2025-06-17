<?php

namespace App\Console\Commands;

use App\Services\FService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TmpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Storage::disk('public')->delete('page_images/e0bb6bdd5e64e6a4823b3d163cb3bb43.jpg');
        return 0;

        $pass = '12345678';
        $hashed = Hash::make($pass);
        dd($hashed);
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            dump($localeCode, $properties);
        }
        app()->setLocale('hy');
        dd(App::getLocale());
        dd(LaravelLocalization::setLocale());
        $a = (new FService())->isJson('{"a":"abc"}');
        dd($a);
    }
}
