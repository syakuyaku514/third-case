<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

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

// ゲスト
// ログイン
Route::get('/', [UserController::class, 'index']);
// 商品カード表示
Route::get('/', [ItemController::class, 'index'])->name('home');
// 商品詳細
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');

// ログイン後
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


