@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="itemshow">
    <div class="item-content">
        <!-- 商品画像 -->
        <div class="item-image">
            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="itemimg">
        </div>
    </div>

    <div class="item-details">
        <!-- 商品名 -->
        <h1>{{ $item->name }}</h1>
  
        <!-- ブランド名 -->
        <p>{{ $item->brandname }}</p>

        <!-- 価格 -->
        <p>¥{{ number_format($item->price) }}（値段）</p>

        <div class="iconform">
            <!-- お気に入りボタン -->
            <form action="{{ route('favorite.toggle') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button type="submit" class="favorite-button">
                    @if (Auth::check() && Auth::user()->favorites()->where('item_id', $item->id)->exists())
                    <img src="{{ asset('img/黄色星.png') }}" alt="お気に入り" class="iconimg">
                @else
                    <img src="{{ asset('img/星.png') }}" alt="お気に入り解除" class="iconimg">
                @endif
                </button>
            </form>
            <p>{{ $favoriteCount }}</p>

            <!-- コメントボタン -->
            <a href="{{ route('item.comment', ['id' => $item->id]) }}">
                <button class="favorite-button">
                <img src="{{ asset('img/吹き出し.png') }}" alt="コメント" class="iconcomment">
            </button>
            </a>
           <p>{{ $commentCount }}</p>
        </div>
    
        <!-- 購入ボタン -->
        @if ($item->isSold())
            <p>この商品は完売しました</p>
        @else
            <form action="{{ route('purchase', ['item_id' => $item->id]) }}" method="GET">
                @csrf
                <button type="submit" class="purchase-button">購入する</button>
            </form>
        @endif

        <!-- 商品説明 -->
        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>

        <!-- 商品の情報 -->
        <h2>商品の情報</h2>
        <ul class="infoul">
            <li class="infoli">カテゴリー 
                @if($item->categories->isNotEmpty())
                    @foreach($item->categories as $category)
                        <span class="categoryspan">{{ $category->name }}</span>
                    @endforeach
                @else
                    カテゴリーが設定されていません。
                @endif
            </li>
            <li class="infoli">商品の状態
                @if($item->condition)
                    <span class="conditionspan">{{ $item->condition->name }}</span>
                @else
                    <span class="conditionspan">状態が設定されていません</span>
                @endif
            </li>
        </ul>
    </div>
</div>
@endsection
