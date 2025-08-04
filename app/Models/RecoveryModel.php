<?php

namespace App\Models;

class RecoveryModel extends BaseModel
{

    protected $table = 'admin_recovery';

    protected $fillable = [
        'user',
        'token',
        'expires',
        'used'
    ];
}
