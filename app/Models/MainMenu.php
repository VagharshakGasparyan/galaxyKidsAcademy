<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    protected $table = 'main_menu';

    protected $fillable = ['name', 'page_id', 'link', 'order', 'parent_id'];

    protected $casts = [
        'name' => 'json',
    ];

    public function parent()
    {
        return $this->belongsTo(MainMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MainMenu::class, 'parent_id')->orderBy('order', 'asc');
    }
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id')->withDefault();
    }

}
