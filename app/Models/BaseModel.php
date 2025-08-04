<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class BaseModel extends Model
{
    use HasTranslations;

    protected $guarded = [
        '_token'
    ];

    protected $translatable = [];

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

    public function toArrayTranslation()
    {
        return parent::toArray();
    }
}
