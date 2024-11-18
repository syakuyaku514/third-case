@extends('layouts.app')

@section('content')
<div class="purchase-page">
    <h1>購入手続き</h1>

    <!-- 商品画像 -->
    <div class="item-image">
        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}">
    </div>

    <!-- 商品名 -->
    <div class="item-name">
        <h2>{{ $item->name }}</h2>
    </div>

    <!-- 商品金額 -->
    <div class="item-price">
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 支払方法 -->
    <div>
        <h2>支払方法</h2>
        <form id="payment-form">
            <label>
                <input type="radio" name="payment_method" value="クレジットカード" checked>
                クレジットカード
            </label>
            <br>
            <label>
                <input type="radio" name="payment_method" value="コンビニ払い">
                コンビニ払い
            </label>
            <br>
            <label>
                <input type="radio" name="payment_method" value="銀行振込">
                銀行振込
            </label>
        </form>
    </div>

    <!-- 配送先 -->
    <div>
        <h2>配送先</h2>
        <a href="{{ route('address.change', ['item_id' => $item->id]) }}">変更する</a>
    </div>




    <div>
        <!-- 確認カード -->

        <!-- 商品代金 -->
        <div class="total-price">
            <h3>商品代金</h3>
            <p>¥{{ number_format($item->price) }}</p>
        </div>

        <!-- 支払い金額 -->
        <div class="total-price">
            <h3>支払い金額</h3>
            <p>¥{{ number_format($item->price) }}</p>
        </div>

        <!-- 支払方法 -->
        <div>
            <h3>支払方法</h3>
            <p id="selected-payment-method">クレジットカード</p>
        </div>
    </div>

    <!-- 購入ボタン -->
    <form action="{{ route('complete_purchase', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        <button type="submit" class="purchase-button">購入する</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 支払い方法のラジオボタンが変更されたときに実行
        const paymentForm = document.getElementById('payment-form');
        const selectedPaymentMethod = document.getElementById('selected-payment-method');

        paymentForm.addEventListener('change', (event) => {
            const selectedOption = document.querySelector('input[name="payment_method"]:checked');
            selectedPaymentMethod.textContent = selectedOption.value;
        });
    });
</script>
@endsection