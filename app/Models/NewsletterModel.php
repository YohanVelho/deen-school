<?php

namespace App\Models;

class NewsletterModel extends BaseModel
{
    protected $table = 'admin_newsletter';

    protected $fillable = [
        'name',
        'email'
    ];
}
