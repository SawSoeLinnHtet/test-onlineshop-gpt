<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// front-end controllers
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController            as FrontendSellerController;
use App\Http\Controllers\SellerDashboardController;

// seller-area controllers
use App\Http\Controllers\Seller\ItemController       as SellerItemController;
use App\Http\Controllers\Seller\CategoryController   as SellerCategoryController;

// admin-area controllers
use App\Http\Controllers\Admin\SellerController      as AdminSellerController;
use App\Http\Controllers\Admin\ProductController     as AdminProductController;
use App\Http\Controllers\Admin\OrderController       as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController    as AdminCategoryController;
use App\Http\Controllers\Admin\ReportController      as AdminReportController;
use App\Http\Controllers\Admin\UserController        as AdminUserController;

/*
|--------------------------------------------------------------------------
| Public Shop
|--------------------------------------------------------------------------
*/
Route::get('/',            [ItemController::class,'index'])->name('shop.home');
Route::get('/item/{id}',   [ItemController::class,'show'])->name('shop.product');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Auth-protected (customer + seller application)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){

    // Cart & checkout
    Route::post('cart/add/{id}',    [CartController::class,'add'])->name('cart.add');
    Route::get ('cart',             [CartController::class,'index'])->name('cart.index');
    Route::post('cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');
    Route::post('cart/clear',       [CartController::class,'clear'])->name('cart.clear');
    Route::get ('cart/checkout',    [CartController::class,'checkout'])->name('cart.checkout');
    Route::post('cart/place-order', [CartController::class,'placeOrder'])->name('cart.placeOrder');
    Route::get ('cart/success/{voucher}', [CartController::class,'success'])
                                           ->name('cart.success');

    // My orders
    Route::get('orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('orders/{id}/cancel', [OrderController::class,'cancelOrder'])->name('orders.cancel');

    // Become a seller (front-end)
    Route::get ('seller/apply', [FrontendSellerController::class,'applyForm'])
         ->name('seller.apply');
    Route::post('seller/apply', [FrontendSellerController::class,'apply'])
         ->name('seller.apply.submit');

    // Seller area (must be is_seller)
    Route::prefix('seller')
         ->middleware('seller')
         ->name('seller.')
         ->group(function(){
             Route::get('dashboard', [SellerDashboardController::class,'index'])
                  ->name('dashboard');
             Route::resource('items',      SellerItemController::class);
             Route::resource('categories', SellerCategoryController::class);
         });
});

/*
|--------------------------------------------------------------------------
| Redirect /home
|--------------------------------------------------------------------------
*/
Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])
     ->name('home');

/*
|--------------------------------------------------------------------------
| Admin area (must be is_admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function(){

        // Dashboard
        Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

        // Seller applications
        Route::get('sellers/pending',          [AdminSellerController::class,'index'])
             ->name('sellers.pending');
        Route::patch('sellers/{user}/approve', [AdminSellerController::class,'approve'])
             ->name('sellers.approve');
        Route::patch('sellers/{user}/ban',     [AdminSellerController::class,'ban'])
             ->name('sellers.ban');

        // Products
        Route::get('products', [AdminProductController::class,'index'])
             ->name('products');

        // Orders
        Route::get('orders', [AdminOrderController::class,'index'])->name('orders');
        Route::get('orders/{id}', [AdminOrderController::class,'show'])->name('orders.show');
        Route::get('orders/{id}/cancel', [AdminOrderController::class,'cancel'])->name('orders.cancel');
        Route::get('orders/{id}/processing', [AdminOrderController::class,'pendingToProcessing'])->name('orders.processing');
        Route::get('orders/{id}/shipped', [AdminOrderController::class,'processingToShipped'])->name('orders.shipped');
        Route::get('orders/{id}/delivered', [AdminOrderController::class,'shippedToDelivered'])->name('orders.delivered');


        // Categories
        Route::get('categories', [AdminCategoryController::class,'index'])
             ->name('categories');

        // Reports
        Route::get('reports', [AdminReportController::class,'index'])
             ->name('reports');

        // Users
        Route::get('users', [AdminUserController::class,'index'])
             ->name('users');
});
