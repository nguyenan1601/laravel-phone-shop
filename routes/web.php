<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/phones', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/phones/{id}', [App\Http\Controllers\ProductController::class, 'show']);
Route::get('/promotions', [App\Http\Controllers\PromotionController::class, 'index']);

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::post('/add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::patch('/update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::delete('/remove-from-cart', [App\Http\Controllers\CartController::class, 'remove']);

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout']);
    Route::post('/place-order', [App\Http\Controllers\OrderController::class, 'placeOrder']);
    Route::post('/check-coupon', [App\Http\Controllers\OrderController::class, 'checkCoupon']);
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/phones/{id}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

require __DIR__.'/auth.php';
