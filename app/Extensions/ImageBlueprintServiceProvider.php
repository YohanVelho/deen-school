<?php

namespace App\Extensions;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;

class ImageBlueprintServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
    }

    public function boot(Router $router)
    {
        Blueprint::macro('image', function($name) {
            $this->string($name)->nullable();
            $this->string($name.'_alt')->nullable();
        });

    }
}
