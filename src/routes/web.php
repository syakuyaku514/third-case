<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoldItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;

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

// 管理者登録
    Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.registerForm');
    Route::post('/admin/register', [AdminController::class, 'registerAdmin'])->name('admin.register.submit');

// 管理者ログイン
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.loginForm');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');


// 管理者
Route::group(['middleware' => ['auth:admin']], function () {
    // 管理者ダッシュボード
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
     
    // 管理者ログアウト
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ユーザー削除
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // コメント削除
    Route::delete('/admin/comments/{comment}', [AdminController::class, 'deleteComment'])->name('admin.comments.delete');
    
    // メール送信機能
    Route::get('/admin/send-email', [AdminController::class, 'showSendEmailForm'])->name('admin.sendEmailForm');
    Route::post('/admin/send-email', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');

        
});

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
    
    // マイページ関係
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mypage/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    
    // ログアウト機能
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // 商品関係
    Route::get('/sell', [ItemController::class, 'create'])->middleware('auth')->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->middleware('auth')->name('items.store');

    // 住所変更
    Route::get('/purchase/address/{item_id}', [SoldItemController::class, 'changeAddress'])->name('address.change');
    Route::post('/purchase/address/{item_id}', [SoldItemController::class, 'changeAddress'])->name('address.change');
    Route::put('/purchase/address/{item_id}', [SoldItemController::class, 'updateAddress'])->name('address.update');

    // お気に入り機能
    Route::get('/item/{id}', [FavoriteController::class, 'show'])->name('item.show');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');

    // コメント機能
    Route::get('/item/{id}/comment', [CommentController::class, 'show'])->name('item.comment');
    Route::post('/item/{id}/comment', [CommentController::class, 'store'])->name('item.comment.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comment.delete');

    // 購入
    Route::get('/purchase/{item_id}', [SoldItemController::class, 'purchase'])->name('purchase');
    Route::post('/complete_purchase/{item_id}', [SoldItemController::class, 'completePurchase'])->name('complete_purchase');
    Route::get('/thank-you', [SoldItemController::class, 'thankYou'])->name('thank_you');

});


