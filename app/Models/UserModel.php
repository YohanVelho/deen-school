<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends BaseModel
{

    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'active'
    ];

    protected $hidden = [
        'password'
    ];

    public function setPermissionsAttribute($value)
    {
        if(is_array($value)){
            $this->attributes['permissions'] = json_encode($value);
        }else{
            $this->attributes['permissions'] = $value;
        }
    }

    public function setPasswordAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
        }
    }
}
