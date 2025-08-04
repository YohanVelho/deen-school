<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\CourseController;
use App\Http\Controllers\Site\LessonController;
use App\Http\Controllers\Site\TranslateController;
use Illuminate\Support\Facades\Route;

Route::get('translate/{language}', [TranslateController::class, 'index'])->name("translate");

Route::middleware('localization')->group(function(){

    Route::get('', [HomeController::class, 'index'])->name("home");
    Route::get('/curso/{slug}', [CourseController::class, 'show'])->name("course");
    Route::get('/aula/{slug}', [LessonController::class, 'show'])->name("lesson");
});
