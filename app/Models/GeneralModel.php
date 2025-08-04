<?php

namespace App\Models;

class GeneralModel extends BaseModel
{
    protected $table = 'admin_general';

    protected $fillable = [
        'logo',
        'logo_alt',
        'favicon',
        'email',
        'phone',
        'whatsapp',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'script_head',
        'script_body',
        'script_footer',
    ];

}
