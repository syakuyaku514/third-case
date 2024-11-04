<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/', [UserController::class, 'index']);

// ログイン後
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


