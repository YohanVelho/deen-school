<?php

namespace App\Models;

class ModulesModel extends BaseModel
{

    protected $table = 'admin_modules';

    protected $fillable = [
        'name',
        'controller',
        'icon',
        'url',
        'crud',
        'position',
        'active',
        'action',
        'parent'
    ];

    public function parent(){
        return $this->hasOne(ModulesModel::class,'id','parent');
    }

    public function children()
    {
        return $this->hasMany(ModulesModel::class,'parent','id')->where('active',1)->where('action', 0)->orderBy('position');
    }
}
