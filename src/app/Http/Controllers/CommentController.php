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

        // お気に入りの件数を取得
        $favoriteCount = $item->favorites()->count();

        // コメントの件数を取得
        $commentCount = $item->comments()->count();

        return view('comments.comment', compact('item', 'comments', 'favoriteCount', 'commentCount'));
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

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // コメントの所有者チェック
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'このコメントを削除する権限がありません。');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました。');
    }
}
