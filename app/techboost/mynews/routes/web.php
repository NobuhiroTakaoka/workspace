<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// 管理者用
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');  // 追記
    Route::get('news/edit', 'Admin\NewsController@edit');  // 追記
    Route::post('news/edit', 'Admin\NewsController@update');  // 追記
    Route::get('news/delete', 'Admin\NewsController@delete');  // 追記
    Route::get('profile/create', 'Admin\ProfileController@add');  // Laravel10 課題4
    Route::post('profile/create', 'Admin\ProfileController@create');  // Laravel14 課題3
    Route::get('profile/edit', 'Admin\ProfileController@edit');  // Laravel10 課題4
    Route::post('profile/edit', 'Admin\ProfileController@update');  // Laravel14 課題6
});

// Laravel10 課題3
Route::get('XXX', 'AAAController@bbb');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 一般ユーザ用
Route::get('/', 'NewsController@index');
