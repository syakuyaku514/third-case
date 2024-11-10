<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Condition;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('home', compact('items'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('items.create', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'condition_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'brandname' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'color' => 'nullable|string|max:50',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像の保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // 現在のユーザーIDを追加
        $validatedData['user_id'] = Auth::id();

        // データベースに保存
        Item::create($validatedData);

        // 出品完了後、ホームページへリダイレクト
        return redirect()->route('home')->with('success', '商品を出品しました！');
    }
}
