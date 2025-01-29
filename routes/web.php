<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

Route::get('/', [FeController::class, 'index'])->name('index');

// Shop
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

//orderadmin
Route::get('/orderadmin', [OrderController::class, 'indexadmin'])->name('admin.orderadmin.index'); // Danh sách đơn hàng (Admin)

Route::get('/orderadmin/{order}', [OrderController::class, 'showadmin'])->name('admin.orderadmin.show'); // Chi tiết đơn hàng

Route::put('/orderadmin/{order}', [OrderController::class, 'updateadmin'])->name('admin.orderadmin.update'); // Cập nhật trạng thái đơn hàng

Route::delete('/orderadmin/{order}', [OrderController::class, 'destroyadmin'])->name('admin.orderadmin.destroy'); // Xóa đơn hàng



Route::get('/', [CartController::class, 'store'])->name('shop.store');


Route::get('/frontend/cart', [CartController::class, 'index'])->name('frontend.cart.index');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/frontend/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/frontend/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/frontend/shop/store', [CartController::class, 'store'])->name('frontend.shop.store');
Route::resource('orders', OrderController::class);
Route::get('/store', [ProductController::class, 'store'])->name('store');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/shop', [CartController::class, 'store'])->name('shop.store');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Users
Route::resource('users', UserController::class);
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

// Categories
Route::resource('categories', CategoryController::class);
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

// Products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::resource('products', ProductController::class);
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/product/{product}', [ProductController::class, 'detail'])->name('frontend.shop.details');
Route::get('/login', function () {
    return view('login');
})->name('login');

// Authentication
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('register', [LoginController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('products/{product}/json', [ProductController::class, 'showJson'])->name('products.showJson');

// Frontend
Route::get('/frontend/index', [FeController::class, 'index'])->name('frontend.index');

// Middleware Groups
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('frontend.index');
    })->name('dashboard');

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/admin', function () {
            return view('admin.users.index');
        })->name('admin.dashboard');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/products', [UserController::class, 'index'])->name('products.index');
});

//about
Route::get('about',[AboutController::class,'index'])->name('frontend.about.index');
//contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');
Route::get('/admin/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/admin/contact', [ContactController::class, 'showMessages'])->name('admin.contact.index');
//checkout:
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/orders', [OrderController::class, 'index'])->name('frontend.orders.index');

//profile:

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('frontend.profile.show');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile', [ProfileController::class, 'show'])->name('frontend.profile.show');




