<?php

namespace App\Models;

class TranslateModel extends BaseModel
{

    protected $table = 'admin_translate';

    protected $fillable = [
        'base',
        'name_pt',
        'name_es',
        'name_en'
    ];

}
