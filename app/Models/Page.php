<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = ['enabled', 'type', 'image', 'images', 'name', 'big_title', 'medium_title', 'small_title', 'content', 'slug'];

    protected $casts = [
        'big_title' => 'json',
        'medium_title' => 'json',
        'small_title' => 'json',
        'content' => 'json',
        'images' => 'array',
    ];
//    protected function casts(): array
//    {
//        return [
//            'big_title' => AsArrayObject::class,
//            'medium_title' => AsArrayObject::class,
//            'small_title' => AsArrayObject::class,
//            'images' => 'array',
//        ];
//    }


    public function mainMenus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MainMenu::class,'page_id','id');
    }

    public static function boot(): void
    {
        parent::boot();
        static::deleting(function ($model) {
            $image = $model->image;
            if($image){
                Storage::disk('public')->delete($image);
            }
            $images = $model->images ?? [];
            foreach($images as $imageItem){
                Storage::disk('public')->delete($imageItem);
            }
        });
    }

}
