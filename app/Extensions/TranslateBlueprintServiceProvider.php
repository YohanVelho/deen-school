<?php

namespace App\Extensions;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;

class TranslateBlueprintServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
    }

    public function boot(Router $router)
    {
        Blueprint::macro('translate', function($callback) {

            $group = new TranslateBlueprint($this);
            call_user_func($callback, $group);

            return $group;
        });

    }
}
