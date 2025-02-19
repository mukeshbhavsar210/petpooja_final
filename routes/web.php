<?php

use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ConfigurationController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SeatController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//Front pages routes
//Route::get('/', [UserController::class, 'show'])->name('front.home');

//Route::get('/menu/{categorySlug?}',[ShopController::class,'category'])->name('front.category');
Route::get('/menu/{menuSlug?}',[ShopController::class,'index'])->name('front.menu');

Route::controller(FrontController::class)->group(function() {
    // In your routes/web.php
    Route::post('dining', 'dinening_store')->name('submit.dining');
    Route::post('takeaway', 'takeaway_store')->name('submit.takeaway');
    Route::post('delivery', 'delivery_store')->name('submit.delivery');
    Route::post('order', 'order_store')->name('submit.order');

    Route::get('/', 'show')->name('front.home');
    Route::get('area/{areaSlug?}', 'restaurant')->name('front.restaurant');
    Route::post('/add-to-wishlist', 'addToWishlist')->name('front.addToWishlist');
    Route::get('/page/{slug}', 'page')->name('front.page');
    Route::post('/send-contact-email', 'sendContactEmail')->name('front.sendContactEmail');

    //add to cart
    Route::get('cart', 'showCartTable');
    Route::get('add-to-cart/{id}', 'addToCart')->name('front.addCart');
    Route::delete('remove-from-cart', 'removeCartItem');
    Route::get('clear-cart', 'clearCart');

    //add to wishlist
    Route::get('favorites', 'wishlist')->name('front.wishlist');
    Route::get('add-to-wishlist/{id}', 'addToWish')->name('addwishlist');
    Route::delete('remove-from-wishlist', 'removeWishlistItem');
    Route::get('clear-wishlist', 'clearWishlist')->name('clear_wishlist');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Category Routes
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/categories', 'index')->name('categories.index');        
        Route::post('/categories', 'store')->name('categories.store');
        Route::post('/category_menu', 'store_menu')->name('categories.store_menu');
        Route::delete('/categories/{category}', 'destroy')->name('categories.delete');
    });

    //Sub Category Routes
    Route::controller(MenuController::class)->group(function() {
        Route::get('/menus', 'index')->name('menu.index');        
        Route::post('/menus', 'store')->name('menu.store');
        Route::get('/menus/{id}/edit', 'edit')->name('menu.edit');
        Route::post('/menus/{id}', 'update')->name('menu.update');
        Route::get('/menus/{id}', 'delete')->name('menu.delete');
        Route::delete('/selected-menus', 'deleteAll')->name('menuall.delete');
    });

    //Product Route     
    Route::controller(ProductController::class)->group(function() {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::post('/product_view', 'view_store')->name('products.store');
        Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        Route::post('/products/{id}',  'update')->name('products.update');
        Route::get('/products/delete/{id}', 'delete')->name('products.delete');
        Route::get('/get-products', 'getProducts')->name('products.getProducts');
    });

    //Sub Categories Connect to main Categories
    Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');

    //Areas Routes
    Route::controller(AreaController::class)->group(function() {
        Route::get('/areas', 'index')->name('areas.index');        
        Route::post('/areas', 'store')->name('areas.store');
        Route::post('/tables', 'store_table')->name('seatings.store');
        Route::get('/areas/{area}/edit', 'edit')->name('areas.edit');
        Route::put('/areas/{area}', 'update')->name('areas.update');
        Route::delete('/areas/{area}', 'destroy')->name('areas.delete');
    });

    //Table Routes
    Route::controller(SeatController::class)->group(function() {
        Route::get('/tables', 'index')->name('tables.index');
        Route::post('/seatings', 'store')->name('seatings.store');
        Route::get('/tables/{table}/edit', 'edit')->name('tables.edit');
        Route::put('/tables/{table}', 'update')->name('tables.update');
        Route::delete('/tables/{table}', 'destroy')->name('tables.delete');
    });

    //Orders Routes
    Route::controller(OrderController::class)->group(function() {
        Route::get('/orders', 'index')->name('orders.index');
        Route::get('/orders/{id}', 'detail')->name('orders.detail');
        Route::post('/order/change-status/{id}', 'changeOrderStatus')->name('orders.changeOrderStatus');
        Route::post('/order/send-email/{id}', 'sendInvoiceEmail')->name('orders.sendInvoiceEmail');
    });

    //Settings Routes
    Route::controller(SettingController::class)->group(function() {
        Route::get('/settings', 'index')->name('settings.index');
        Route::post('/settings/website_information', 'websiteInformation')->name('settings.websiteInformation');                
        Route::post('/settings/branch', 'branch')->name('settings.branch');                
        //Route::post("/updateWebsiteLogo",'update_logo')->name('website.logo');
    });

    //Pages Routes
    Route::controller(PageController::class)->group(function() {
        Route::get('/pages', 'index')->name('pages.index');
        Route::get('/pages/create', 'create')->name('pages.create');
        Route::post('/pages', 'store')->name('pages.store');
        Route::get('/pages/{page}/edit', 'edit')->name('pages.edit');
        Route::put('/pages/{page}', 'update')->name('pages.update');
        Route::delete('/pages/{page}', 'destroy')->name('pages.delete');
    });
    
    //Profile
    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    //Permissions
    Route::controller(PermissionController::class)->group(function() {
        Route::get('/permissions', 'index')->name('permissions.index');
        Route::get('/permissions/create', 'create')->name('permissions.create');
        Route::post('/permissions', 'store')->name('permissions.store');
        Route::get('/permissions/{id}/edit', 'edit')->name('permissions.edit');
        Route::post('/permissions/{id}', 'update')->name('permissions.update');
        Route::delete('/permissions', 'destroy')->name('permissions.destroy');
        Route::post("/updateWebsiteLogo", 'update_logo')->name('website.logo');
    });

    //Roles   
    Route::controller(RoleController::class)->group(function() { 
        Route::get('/roles','index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::post('/roles', 'store')->name('roles.store');
        Route::get('/roles/{id}/edit', 'edit')->name('roles.edit');
        Route::post('/roles/{id}', 'update')->name('roles.update');
        Route::delete('/roles', 'destroy')->name('roles.destroy');
    });

    //Permissions
    Route::controller(ConfigurationController::class)->group(function() { 
        Route::get('/configurations', 'index')->name('configurations.index');
        Route::get('/configurations/create', 'create')->name('configurations.create');
        Route::post('/configurations', 'store')->name('configurations.store');
        Route::post('/configurations/theme', 'store_theme')->name('configurations.theme');
        Route::get('/configurations/{id}/edit', 'edit')->name('configurations.edit');
        Route::post('/configurations/{id}', 'update')->name('configurations.update');
        Route::delete('/configurations', 'destroy')->name('configurations.destroy');
        Route::post('/payment', 'store_payment')->name('payment.store');
        Route::get('configurations/branch/delete/{id}', 'delete')->name('delete.branch');
    });
    
    //Users
    Route::controller(UserController::class)->group(function() { 
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users',  'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::post('/users/{id}', 'update')->name('users.update');
        Route::delete('/users', 'destroy')->name('users.destroy');        
        Route::get('/logout', 'logout')->name('users.logout');
    }); 

    Route::get('/getSlug', function(Request $request){
        $slug = '';
        if (!empty($request->title)) {
            $slug = Str::slug($request->title);
        }
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    })->name('getSlug');

});

require __DIR__.'/auth.php';