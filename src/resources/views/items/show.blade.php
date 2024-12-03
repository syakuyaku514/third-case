@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection


@section('content')
    <div class="">
        <div class="item">
            <!-- 商品画像 -->
            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}">
        </div>

        <!-- 商品名 -->
        <h1>{{ $item->name }}</h1>

        <!-- ブランド名 -->
        <p>{{ $item->brandname }}</p>

        <!-- 価格 -->
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
        <p>カラー: {{ $item->color }}</p>
        <p>{{ $item->description }}</p>

        <!-- 商品の情報 -->
        <h2>商品の情報</h2>
        <ul>
            <li>カテゴリー: 
                @if($item->categories->isNotEmpty())
                    @foreach($item->categories as $category)
                        <span>{{ $category->name }}</span>
                    @endforeach
                @else
                    カテゴリーが設定されていません。
                @endif
            </li>
            <li>商品の状態: 
                @if($item->condition)
                    {{ $item->condition->name }}
                @else
                    状態が設定されていません。
                @endif
            </li>
        </ul>
    </div>
@endsection