<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;

class SoldItemController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id); // item_idに対応する商品を取得

        return view('items.purchase', compact('item')); // 購入ページにデータを渡す
    }

    // 住所変更ページの表示
    public function changeAddress($item_id)
    {
        $profile = Profile::where('user_id', auth()->id())->first();
        // item_idを使って住所変更ページを表示
        return view('items.change_address', compact('profile', 'item_id'));
    }

    public function editProfile($userId)
    {
        $profile = Profile::where('user_id', $userId)->first();

        return view('profile.edit', compact('profile'));
    }

    public function updateAddress(Request $request, $item_id)
    {

        return redirect()->route('purchase.confirmation');
    }
}
