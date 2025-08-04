<?php

/*
|--------------------------------------------------------------------------
| Admin Routes - /gerenciador
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Models\ModulesModel;
use Illuminate\Support\Facades\App;

// LOGIN
Route::redirect('/', '/gerenciador/dashboard');
Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('admin.login');
Route::match(['get','post'], '/recuperar', [LoginController::class, 'recovery'])->name('admin.login.recovery');
Route::match(['get','post'], '/resetar/{token}', [LoginController::class, 'reset'])->name('admin.login.reset');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.login.logout');

Route::middleware('admin')->group(function(){

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/translations', [DictionaryController::class, 'index'])->name('admin.languages');
    Route::post('translations/update', [DictionaryController::class,'transUpdate'])->name('translation.update.json');
    Route::post('translations/updateKey', [DictionaryController::class,'transUpdateKey'])->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', [DictionaryController::class,'destroy'])->name('translations.destroy');
    Route::post('translations/create', [DictionaryController::class,'store'])->name('translations.create');

    // MODULES
    if(!App::runningInConsole()){
        $modules = ModulesModel::where('active', 1)->where('crud', 1)->get()->toArray();
        foreach ($modules as $module) {
            if(!empty($module['url'])){
                Route::prefix('/' . $module['url'] . ($module['action'] ? '/{fk}' : ''))->group(function () use ($module) {
                    Route::get('', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@index')->name('admin.' . $module['url']);
                    Route::get('/view/{id}', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@view')->name('admin.' . $module['url'] . '.view');
                    Route::get('/export', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@export')->name('admin.' . $module['url'] . '.export');
                    Route::delete('/{id}', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@delete')->name('admin.' . $module['url'] . '.delete');
                    Route::match(['get', 'post'], '/adicionar', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@form')->name('admin.' . $module['url'] . '.create');
                    Route::match(['get', 'post'], '/editar/{id}', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@form')->name('admin.' . $module['url'] . '.edit');
                    Route::post('/sort', '\App\Http\Controllers\Admin\\' . $module['controller'] . '@sort')->name('admin.' . $module['url'] . '.sort');
                });
            }
        }
    }

});


Route::get('/back', function(){
    if(count(session('last')) > 0){
        $last = session('last');
        $url = array_pop($last);
        session([
            'last' => $last
        ]);
        return redirect($url);
    }
})->name('admin.back');
