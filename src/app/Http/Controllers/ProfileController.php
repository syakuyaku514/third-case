<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showMyPage()
    {
        $user = Auth::user();

        // プロフィール情報
        $profile = $user->profile;
        $hasProfile = $user->profile()->exists();

        // 出品した商品
        $listedItems = Item::where('user_id', $user->id)->get();

        // 購入した商品
        $purchasedItems = \DB::table('sold_items')
            ->join('items', 'sold_items.item_id', '=', 'items.id')
            ->where('sold_items.user_id', $user->id)
            ->select('items.*', 'sold_items.created_at as purchased_at')
            ->get();

        return view('mypage', compact('profile', 'hasProfile', 'listedItems', 'purchasedItems'));
    }
    
    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('mypage.profile', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $data = $request->only(['name', 'post', 'address', 'building']);

        \Log::info('リクエストデータ全体: ' . print_r($request->all(), true));


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $data['image'] = $path;
        }

        $data['user_id'] = $user->id;
        Profile::create($data);

        return redirect()->route('profile.edit')->with('success', 'プロフィールが作成されました。');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $data = $request->only(['name', 'post', 'address', 'building']);

        // 画像がアップロードされた場合の処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $data['image'] = $path;
        }

        // 既存プロフィールの更新
        $user->profile->update($data);

        return redirect()->route('profile.edit')->with('success', 'プロフィールが更新されました。');
    }

    public function create()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('mypage.profile', compact('profile'));
    }

}
