<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AdminAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::prefix(LaravelLocalization::setLocale().'/admin')->
    middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->
    group(function(){
        Route::get('/',function(){
              return view('dashboard.home');
        })->name('admin.dashboard');
        Route::get('login',[AdminAuthController::class,'index']);
        Route::post('login',[AdminAuthController::class,'login'])->name('admin.login');

    });