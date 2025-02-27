<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : view('welcome');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');


Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Route untuk menghapus pengguna
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');


require __DIR__.'/auth.php';

Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');

Route::middleware('auth')->group(function () {
    Route::get('/home', [ShopController::class, 'index'])
        ->middleware('auth')
        ->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::get('/total-users', [DashboardController::class, 'totalUsers'])->name('total.users');
    Route::get('/total-sales', [DashboardController::class, 'totalSales'])->name('total.sales');
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Wishlist Routes
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/check/{productId}', [WishlistController::class, 'checkWishlist']);
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});

// Order History Routes
Route::middleware('auth')->group(function () {
    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order_history.index');
    Route::post('/order-history', [OrderHistoryController::class, 'store'])->name('order_history.store');
    Route::post('/pesan-sekarang', [OrderHistoryController::class, 'store'])->name('pesan.sekarang');
    Route::delete('/orders/{id}/remove', [OrderHistoryController::class, 'destroy'])->name('orders.remove');
});

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/keranjang', [ShopController::class, 'keranjang'])->name('keranjang');
Route::post('/add-to-keranjang', [ShopController::class, 'addToKeranjang'])->name('add-to-keranjang');
Route::post('/update-keranjang', [ShopController::class, 'updateKeranjang'])->name('update-keranjang');
Route::get('/remove-from-keranjang/{id}', [ShopController::class, 'removeFromKeranjang'])->name('remove-from-keranjang');
Route::get('/halamantambah', [ShopController::class, 'halamantambah'])->name('halamantambah');
Route::post('/tambah-product', [ShopController::class, 'tambahProduct'])->name('tambah-product');

