<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
{
    $user = Auth::user();

    // 既存の状態を確認
    $favorite = Favorite::where('user_id', $user->id)
        ->where('item_id', $request->item_id)
        ->first();

    if ($favorite) {
        // お気に入りから削除
        $favorite->delete();
    } else {
        // お気に入りに追加
        Favorite::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
        ]);
    }

    // 元のページにリダイレクト
    return redirect()->route('item.show', ['id' => $request->item_id]);
}
}
