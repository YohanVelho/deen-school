<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageModel extends BaseModel
{
    protected $table = 'admin_languages';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'position',
        'active'
    ];

}
