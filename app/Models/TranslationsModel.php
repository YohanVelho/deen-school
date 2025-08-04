<?php

namespace App\Models;

class TranslationsModel extends BaseModel
{

    protected $table = 'admin_translations';

    protected $translatable = [
        'name',
        'text'
    ];
}
