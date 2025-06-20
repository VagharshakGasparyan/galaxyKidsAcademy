<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyConfig extends Model
{
    protected $table = 'my_configs';

    protected $fillable = ['key', 'group_key', 'json_value', 'value1', 'value2', 'value3', 'description'];

    protected $casts = [
        'json_value' => 'json',
    ];

}
