<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('language')){
            App::setLocale(session('language'));
        }

        $exp = explode('-',Route::currentRouteName());
        if(count($exp) > 1){
            App::setLocale($exp[1]);
        }

        return $next($request);
    }
}
