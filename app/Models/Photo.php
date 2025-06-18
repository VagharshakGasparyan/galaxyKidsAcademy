<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = ['enabled', 'image', 'title', 'description'];

    protected $casts = [
        'title' => 'json',
        'description' => 'json',
    ];


    public static function boot(): void
    {
        parent::boot();
        static::deleting(function ($model) {
            $image = $model->image;
            if($image){
                Storage::disk('public')->delete($image);
            }
        });
    }
}
