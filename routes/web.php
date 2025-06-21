<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\FrontBrandController;
use App\Http\Controllers\FrontProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductDetailsController;
use Livewire\Livewire;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchlistController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Countary;
use App\Models\Faq;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
    Route::get('/', function () {
        $products = Product::with('images', 'category', 'brand')->latest()->limit(8)->get();
        $brands = Brand::limit(12)->get();
        $saleProducts = Product::with('images', 'category', 'brand')->where('has_discount', 1)->limit(12)->get();
        $flasSaleProducts = Product::where('has_discount', 1)->with('images', 'category', 'brand')->where('available_for', date('y-m-d'))->get();

        return view('front.home', ['brands' => $brands, 'products' => $products, 'saleProducts' => $saleProducts, 'flasSaleProducts' => $flasSaleProducts]);
    })->name('home');
    Route::get('viewAllCategoris', function () {
        $all_categories = Category::all();
        return view('front.categories.index', ['allCategories' => $all_categories]);
    })->name('allcategories');

    Route::get('viewAllBrands', function () {
        $all_brands = Brand::all();
        return view('front.brands.index', ['allBrands' => $all_brands]);
    })->name('allBrands');
    Route::get('user-dashboard', function () {
        $country = Countary::where('id', Auth::guard('web')->user()->country_id)->with('governorates')->first();
        $governorate = Governorate::where('id', Auth::guard('web')->user()->governorate_id)->first();
        $orders = Order::where('user_id', auth()->user()->id)->with('items.product.images')->latest()->get();

        return view('front.users.user-dashboard', get_defined_vars());
    })->middleware('auth')->name('user-dashboard');
    Route::get('pages/{slug}', [PageController::class, 'gotToPage'])->name('goToPage');
    Route::get('about-us', function () {
        return view('front.pages.about-us');
    })->name('about-us');
    Route::get('faqs', function () {
        $faqs = Faq::get();
        return view('front.pages.faqs', ['faqs' => $faqs]);
    })->name('faq');
    Route::controller(FrontProductController::class)->group(function () {
        Route::get('category/{slug}/products', 'getProductsByCategories')->name('getProductsByCategories');
        Route::get('brand/{slug}/products', 'getProductsByBrand')->name('getProductsByBrand');
        Route::get('arrival/products', 'getArrivalProducts')->name('arrival');
        Route::get('products/{type}', 'getProducts')->name('flash');
    });
    Route::get('checkout', function () {
        return view('front.checkout.checkout');
    })->name('checkout');
    Route::controller(ProductDetailsController::class)->group(function () {
        Route::get('product/{slug}', 'getProductDetails')->name('getProductDetails');
    });
    Route::controller(WatchlistController::class)->middleware('auth')->group(function () {
        Route::get('wichlist', 'index')->name('watchlist.index');
        Route::get('wichlist/store/{product}', 'store')->name('wichlist.store');
    });
    Route::controller(CartController::class)->group(function () {
        Route::get('cart', 'index')->name('cart.index');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/track-order', 'showForm')->name('orders.track.form');
        Route::get('/order/{order_number}', 'getOrder')->name('front.order');
        Route::post('/track-order', 'trackOrder')
            ->middleware('throttle:5,1') // 5 محاولات كل دقيقة
            ->name('orders.track');
    });
    Route::get('contct-us',function(){
        return view('front.contacts.index');
    })->name('contact-us');
});

Route::get('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('myfatoorah.callback');
Route::get('/payment/error', [PaymentController::class, 'paymentError'])->name('myfatoorah.error');
Route::get('auth/google', [RegisteredUserController::class, 'googleAuth'])->name('google.auth');
Route::get('auth/google/callback', [RegisteredUserController::class, 'redirect'])->name('google.callback');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
