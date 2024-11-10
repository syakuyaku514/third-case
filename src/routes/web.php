<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoldItemController;

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
    Route::get('/mypage', [ProfileController::class, 'showMyPage'])->name('mypage');
    
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mypage/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/sell', [ItemController::class, 'create'])->middleware('auth')->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->middleware('auth')->name('items.store');

    Route::get('/purchase/{item_id}', [SoldItemController::class, 'purchase'])->name('purchase');
    Route::get('/purchase/complete/{item_id}', [PurchaseController::class, 'completePurchase'])->name('complete_purchase');

    Route::get('/purchase/address/{item_id}', [SoldItemController::class, 'changeAddress'])->name('address.change');
    Route::post('/purchase/address/{item_id}', [SoldItemController::class, 'changeAddress'])->name('address.change');

    Route::post('/purchase/address/{item_id}', [SoldItemController::class, 'updateAddress'])->name('address.update');
});


