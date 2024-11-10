@extends('layouts.app')

@section('content')
<div class="purchase-page">
    <h1>購入手続き</h1>

    <!-- 商品画像 -->
    <div class="item-image">
        <img src="{{ asset('img/商品写真.png') }}" alt="商品画像">
    </div>

    <!-- 商品名 -->
    <div class="item-name">
        <h2>{{ $item->name }}</h2>
    </div>

    <!-- 商品代金 -->
    <div class="item-price">
        <p>商品代金: ¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 支払い方法 -->
    <div class="payment-method">
        <!-- <h3>支払い方法</h3>
        <p>コンビニ払い</p>
        <a href=""></a> -->
        <!-- 支払い方法変更リンク -->
    </div>

    <!-- 支払い金額 -->
    <div class="total-price">
        <h3>支払い金額</h3>
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 配送先 -->
    <div class="delivery-address">
        <h3>配送先</h3>
        <p>（ユーザーの配送先住所）</p>
        <a href="{{ route('address.change', ['item_id' => $item->id]) }}">変更する</a>
    </div>

    <!-- 購入ボタン -->
    <form action="{{ route('complete_purchase', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        <button type="submit" class="purchase-button">購入する</button>
    </form>
</div>
@endsection