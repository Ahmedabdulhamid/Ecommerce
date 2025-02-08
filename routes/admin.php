<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CountaryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuperAdminController;
use SebastianBergmann\LinesOfCode\Counter;

Route::prefix(LaravelLocalization::setLocale() . '/admin')->
    middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->
    group(function () {
        Route::get('/', function () {
            return view('dashboard.home');
        })->name('admin.dashboard')->middleware('guest_:admin');



        Route::middleware('auth_:admin')->controller(AdminAuthController::class)->group(function () {
            Route::get('login', 'index')->name('login.get');
            Route::post('login', 'login')->name('admin.login');
            Route::get('recover-password', 'recover_password')->name('admin.recover-password');
            Route::post('recover-password', 'post_recover_password')->name('admin.post.recover-password');
            Route::get('reset_password/{token}', 'reset_password')->name('admin.reset_password');
            Route::post('reset_password', 'update_password')->name('admin.post.reset_password');
            //Route::view('update-password','dashboard.auth.reset_password')->name('admin.update-password');
        });
        Route::middleware('guest_:admin')->group(function () {
            Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
            Route::resource('roles', RoleController::class);
            Route::controller(SuperAdminController::class)->group(function () {
                Route::get('/manage-admins', 'index')->name('superadmins.index');
                Route::post('/assign-role', 'assignRoles')->name('superadmins.assignRole');
                Route::post('/assign-permission', 'assignPermission')->name('superadmins.assignPermission');

            });
            Route::get('/countaries',[CountaryController::class,'index'])->name('countaries.index');
            Route::post('/countaries/edit',[CountaryController::class,'edit'])->name('countaries.edit');
        });



    });
