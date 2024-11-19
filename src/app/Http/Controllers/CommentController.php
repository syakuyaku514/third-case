<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $comments = Comment::where('item_id', $id)
                       ->with('user.profile') // プロフィールまでリレーションをロード
                       ->get();

        return view('comments.comment', compact('item', 'comments'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('item.comment', ['id' => $id])
                         ->with('success', 'コメントを投稿しました');
    }
}
