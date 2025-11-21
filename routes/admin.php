<?php

use App\Http\Controllers\Admin\UserFaqQuestion;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountaryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserQuestions;
use App\Livewire\Admin\Attributes\GetData;
use App\Livewire\CouponGetData;
use App\Livewire\Test;
use Illuminate\Support\Facades\Gate;


Route::prefix(LaravelLocalization::setLocale() . '/admin')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('admin.dashboard')->middleware('guest_:admin');
        Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle)->name('livewire.update')->withoutMiddleware(['localization']);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle)->name('livewire.js')->withoutMiddleware(['localization']);
});



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
        Route::get('roles/data', [RoleController::class, 'getData'])->name('roles.getData');
        Route::get('roles/{role}/details', [RoleController::class, 'showDetails'])->name('roles.showDetails');
        Route::resource('roles', RoleController::class);
        Route::get('admins/data', [AdminController::class, 'getData'])->name('admins.getData');
        Route::resource('admins', AdminController::class);
        Route::post('assignRole/{admin}', [AdminController::class, 'assignRole'])->name('admins.assignRole');


        Route::get('/countaries', [CountaryController::class, 'index'])->name('countaries.index');
        Route::get('/countaries/governorates/{id}', [CountaryController::class, 'show'])->name('governorates.show');
        Route::post('/countaries/governorates', [CountaryController::class, 'searchByGovernorates'])->name('governorates.searchByGovernorates');
        Route::post('/countaries/edit', [CountaryController::class, 'edit'])->name('countaries.edit');
        Route::post('/countaries/governorates/edit', [CountaryController::class, 'editGovernorate'])->name('governorates.edit');
        Route::post('/countaries/governorates/price/edit', [CountaryController::class, 'editGovernoratePrice'])->name('governoratesPrice.edit');
        Route::post('/countaries/governorates/search', [CountaryController::class, 'search'])->name('governorates.search');
        Route::get('categories/Data', [CategoryController::class, 'getCategoriesData'])->name('getCategories.index');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::get('/recycle-bin', [CategoryController::class, 'getRecycleBinData'])->name('categories.recyclebin');
        Route::get('/recycle-bin/{category}', [CategoryController::class, 'restoreCategory'])->name('categories.restore');
        Route::get('/delete/{category}', [CategoryController::class, 'DeleteCategory'])->name('categories.delete');
        Route::delete('/force-delete/{category}', [CategoryController::class, 'DeleteCategoryFinal'])->name('categories.forcedelete');
        Route::post('category/edit-status', [CategoryController::class, 'editStatus'])->name('editStatusCategories');
        Route::get('/brand/data', [brandController::class, 'getBrandsData'])->name('getBrands.index');
        Route::resource("brands", brandController::class)->except('show');
        Route::post("brands/status", [brandController::class, 'editStatus'])->name('editStatus');
        Route::get('/brand/recycle-bin', [BrandController::class, 'getRecycleBinData'])->name('brands.recyclebin');
        Route::get('/brand/recycle-bin/{brand}', [BrandController::class, 'restoreBrand'])->name('brands.restore');
        Route::get('/delete/{brand}', [BrandController::class, 'DeleteBrand'])->name('brands.delete');
        Route::get('/brand/force-delete/{brand}', [BrandController::class, 'DeleteBrandFinal'])->name('brands.forcedelete');
        Route::get('coupones/data', [CouponGetData::class, 'getData'])->name('coupones.index');
        Route::get('/coupones', function () {
            return view('dashboard.coupones.index');
        })->name('coupones');
        Route::get('/coupons/create', function () {
            if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
                abort(403);
            }
            return view('dashboard.coupones.create');
        })->name('coupons.create');
        Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupons.store');
        Route::post('/coupon/edit', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::get('coupon/destroy/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
        Route::resource('faqs', FaqsController::class);
        Route::get('settings', function () {
            return view('dashboard.Settings.index');
        })->name('settings.index');
        Route::get('/attributes/data', [GetData::class, 'getData'])->name('attributes.index');
        Route::get('/attributes', function () {
            return view('dashboard.attributes.index');
        })->name('attributes');
        Route::get('user-faqs/data',[UserFaqQuestion::class,'getData'])->name('user-faqs.getData');
        Route::resource('user-faqs',UserFaqQuestion::class);
        Route::post('answer-ques/{id}',[UserFaqQuestion::class,'answerQuestion'])->name('user-faqs.answer');
        Route::get('permission/data', [PermissionController::class, 'getData'])->name('permission.getData');
        Route::resource('permissions', PermissionController::class);
        Route::get('products/data', [ProductController::class, 'getData'])->name('products.getData');
        Route::get('products/status/{id}', [ProductController::class, 'changeStatus'])->name('products.changestatus');
        Route::resource('products', ProductController::class);
        Route::get('variant/{id}', [ProductController::class, 'deleteVariant'])->name('variants.delete');
        Route::get('users/data', [UserController::class, 'getData'])->name('users.getData');
        Route::resource('users', UserController::class);
        Route::get('users/status/{id}', [UserController::class, 'changeStatus'])->name('users.changestatus');
        Route::get('contacts', [ContactController::class, 'index'])->middleware('markAsRead')->name('contacts.index');
        Route::get('sliders/data', [SliderController::class, 'getData'])->name('sliders.getData');
        Route::resource('sliders', SliderController::class);
        Route::get('pages/data', [PageController::class, 'getData'])->name('pages.getData');
        Route::resource('pages', PageController::class);
        Route::get('questions/getData', [UserQuestions::class, 'getData'])->name('questions.getData');
        Route::resource('questions', UserQuestions::class);
        Route::post('answer/{question}', [UserQuestions::class, 'answer'])->name('question.answer');
        Route::controller(AdminOrderController::class)->group(function () {
            Route::get('orders/data', 'getData')->name('orders.data');
            Route::get('orders', 'index')->name('orders.index');
            Route::get('orders/{id}', 'destroy')->name('orders.destroy');
            Route::get('orders/{id}/show', 'show')->middleware('markAsRead')->name('orders.show');
            Route::put('orders/{id}', 'update')->name('orders.update');
             Route::patch('orders/{id}', 'updateStatus')->name('orders.updateStatus');
        });
    });

});

