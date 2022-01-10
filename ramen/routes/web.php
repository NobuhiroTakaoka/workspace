<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Member\ShopController;
use App\Http\Controllers\Member\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// ユーザ共通
// Route::get('/', 'InfoController@index');
// Laravel8での書き方 認証済みユーザーでなくてもこのルートにアクセス可能にし、Viewで表示を制御したい
Route::get('/', [InfoController::class, 'index']);
Route::get('/search', [InfoController::class, 'search'])->name('search');
Route::get('/ranking', [InfoController::class, 'ranking'])->name('ranking');
// Route::get('/entry', [ShopController::class, 'add']);
// Route::get('/detail/{shop_id}/shop_edit', [ShopController::class, 'edit']);
Route::get('/shop/detail/{shop_id}', [App\Http\Controllers\ShopController::class, 'refer'])->name('shop.detail');
Route::get('/shop/detail/review_refer/{shop_id}', [App\Http\Controllers\ShopController::class, 'review_refer'])->name('shop.review_refer');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログインユーザ
Route::group(['prefix' => 'member', 'middleware' => 'auth'], function () {
    Route::get('/{user_id}/profile_edit', [UserController::class, 'edit']);
    Route::get('/{user_id}/review_manage', [UserController::class, 'manage']);
    Route::get('/{user_id}', [UserController::class, 'index'])->name('{user_id}');
    Route::get('/shop/entry', [ShopController::class, 'add'])->name('shop.entry');
    // Route::post('/shop/entry', [ShopController::class, 'fix']);
    // Route::post('/shop/fix', [ShopController::class, 'fix']);
    Route::post('/shop/check', [ShopController::class, 'check'])->name('check');
    Route::post('/shop/create', [ShopController::class, 'create'])->name('create');
    Route::get('/shop/detail/shop_edit/{shop_id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop/detail/confirm/{shop_id}', [ShopController::class, 'confirm'])->name('shop.confirm');
    Route::get('/shop/detail/review_add/{shop_id}', [ShopController::class, 'review_add'])->name('shop.review_add');
});
