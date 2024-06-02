<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToppageController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ToppageController::class, 'index'])->name('top');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::get('users/mypage/book', 'book')->name('mypage.book');
});

Route::get('subscription', [StripeController::class, 'subscription'])->name('stripe.subscription');
Route::post('subscription/store', [StripeController::class, 'store'])->name('stripe.store');
Route::get('subscription/edit', [StripeController::class, 'edit'])->name('stripe.edit');
Route::put('subscription', [StripeController::class, 'update'])->name('stripe.update');
Route::get('subscription/cancel_confirm', [StripeController::class, 'cancel_confirm'])->name('stripe.cancel_confirm');
Route::delete('subscription/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

/* 第一引数にベースとなるURL(resource/view/xxx)を文字列で渡し、第二引数で使用するコントローラを指定 */
Route::resource('shops', ShopController::class)->middleware(['auth', 'verified']);
Route::resource('company', CompanyController::class);
Route::resource('caregories', CategoryController::class)->middleware(['auth', 'verified']);

Route::controller(ReviewController::class)->group(function () {
    Route::post('shops/{shop}/reviews', 'store')->name('reviews.store');
    Route::get('shops/{shop}/reviews/{review}/edit', 'edit')->name('reviews.edit');
    Route::put('shops/{shop}/reviews/{review}/update', 'update')->name('reviews.update');
    Route::delete('shops/{shop}/reviews/{review}/destroy', 'destroy')->name('reviews.destroy');
});

Route::controller(BookController::class)->group(function () {
    Route::get('shops/{shop}/books/create', 'create')->name('books.create');
    Route::post('shops/{shop}/books', 'store')->name('books.store');
    Route::delete('shops/{shop}/books/{book}/cancel', 'cancel')->name('books.cancel');
});

Route::get('shops/{shop}/favorite', [ShopController::class, 'favorite'])->name('shops.favorite');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
