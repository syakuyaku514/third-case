@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection


@section('content')
    <div class="">
        <div class="item">
            <!-- 商品画像 -->
            <img src="{{ asset('img/商品写真.png') }}" alt="商品画像">
        </div>

        <!-- 商品名 -->
        <h1>{{ $item->name }}</h1>

        <!-- ブランド名 -->
        <p>{{ $item->brandname }}</p>

        <!-- 価格 -->
        <p>¥{{ number_format($item->price) }}（値段）</p>

        <button>お気に入りボタン</button>
        <button>コメントボタン</button>
        
        <!-- 購入ボタン -->
        <button class="purchase-button">購入する</button>

        <!-- 商品説明 -->
        <h2>{{ $item->description }}</h2>
        <p>カラー: {{ $item->color }}</p>

        <!-- 状態 -->
        <p>{{ $item->condition->name }}</p>

        <p>
            @if($item->condition->id == 1) <!-- 新品 -->
                商品の状態は良好です。傷もありません。
            @elseif($item->condition->id == 2) <!-- 良好 -->
                商品の状態は良好です。
            @elseif($item->condition->id == 3) <!-- 中古 -->
                この商品は中古品です。
            @endif
        </p>

        <!-- 発送について -->
        <p>購入後、即発送いたします。</p>

        <!-- 商品の情報 -->
        <h2>商品の情報</h2>
        <ul>
            <li>カテゴリー: {{ $item->category->name }}</li>
            <li>商品の状態: {{ $item->condition->name }}</li>
        </ul>
    </div>
@endsection