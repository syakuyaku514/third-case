@extends('layouts.app')

@section('content')
<div>
    <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}">
    <h1>{{ $item->name }}</h1>
    <p>{{ $item->brand }}</p>
    <p>¥{{ number_format($item->price) }}（値段）</p>

    <form action="{{ route('favorite.toggle') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <button type="submit" class="favorite-button">
                @if (Auth::check() && Auth::user()->favorites()->where('item_id', $item->id)->exists())
                    <img src="{{ asset('img/黄色星.png') }}" alt="お気に入り">
                @else
                    <img src="{{ asset('img/星.png') }}" alt="お気に入り解除">
                @endif
            </button>
        </form>

    <a href="{{ route('item.comment', ['id' => $item->id]) }}">
        <button>コメントボタン</button>
    </a>

    <!-- コメント一覧 -->
    <ul>
    @foreach ($comments as $comment)
    <!-- アイコンの大きさをCSSで表示！！ -->
        <li style="display: flex; align-items: center; margin-bottom: 1rem;">
            <!-- ユーザーアイコン -->
            <img src="{{ $comment->user && $comment->user->profile && $comment->user->profile->image 
                         ? asset('storage/' . $comment->user->profile->image) 
                         : asset('images/default-icon.png') }}" 
                 alt="プロフィールアイコン" 
                 style="width: 50px; height: 50px; border-radius: 50%; margin-right: 1rem;">


            <!-- ユーザー名とコメント内容 -->
            <div>
                <p>{{ $comment->user && $comment->user->profile 
                        ? $comment->user->profile->name 
                        : 'ゲストユーザー' }}</p>
                <p>{{ $comment->comment }}</p>

                <!-- コメント削除ボタン -->
                @if (Auth::check() && Auth::id() === $comment->user_id)
                <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST" style="margin-left: auto;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
                    削除
                </button>
                </form>
                @endif
            </div>
        </li>
    @endforeach
    </ul>

    <h2>商品へのコメント</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    

    <form action="{{ route('item.comment.store', ['id' => $item->id]) }}" method="POST">
        @csrf
        <textarea name="comment" rows="4" required></textarea>
        <button type="submit">コメントを送信する</button>
    </form>
</div>
@endsection