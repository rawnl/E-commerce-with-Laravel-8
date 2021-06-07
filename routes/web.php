<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('signin');
});

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/logout', function(){
    Session::forget('user');
    return redirect(route('home'));
})->name('logout');

Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');

Route::get('search', [ProductController::class, 'search'])->name('search');

Route::post('/add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

Route::get('/remove_from_cart/{id}', [ProductController::class, 'removeFromCart'])->name('remove_from_cart');

Route::get('/order_now', [ProductController::class, 'orderNow'])->name('order_now');

Route::post('/confirm_order', [ProductController::class, 'confirmOrder'])->name('confirm_order');

Route::get('/myorders', [ProductController::class, 'myOrders'])->name('myorders');

Route::get('/dashboard',[ProductController::class, 'dashboard'])->name('dashboard');

Route::get('/orders', [ProductController::class, 'orders'])->name('orders');

Route::get('/products', [ProductController::class, 'products'])->name('products');

Route::get('/clients', [UserController::class, 'clients'])->name('clients');

Route::get('/validateOrder/{id}', [ProductController::class, 'validateOrder'])->name('validateOrder');

Route::get('/cancelOrder/{id}', [ProductController::class, 'cancelOrder'])->name('cancelOrder');

Route::post('/editProduct', [ProductController::class, 'editProduct'])->name('editProduct');

Route::get('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

Route::post('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');

Route::get('/blockUser/{id}', [UserController::class, 'blockUser'])->name('blockUser');

Route::get('/unblockUser/{id}', [UserController::class, 'unblockUser'])->name('unblockUser');


/*
Route::group(['middleware' => ['auth', 'type:USR']], function(){
    Route::post('/add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');
    Route::get('/remove_from_cart/{id}', [ProductController::class, 'removeFromCart'])->name('remove_from_cart');
    Route::get('/order_now', [ProductController::class, 'orderNow'])->name('order_now');
    Route::post('/confirm_order', [ProductController::class, 'confirmOrder'])->name('confirm_order');
    Route::get('/myorders', [ProductController::class, 'myOrders'])->name('myorders');
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
});
*/
