<?php

namespace App\Models;

class SeoModel extends BaseModel
{

    protected $table = 'admin_seo';

    protected $fillable = [
        'link',
        'title',
        'description',
        'keywords',
        'canonical',
        'seo_img'
    ];
}
