@extends('layouts.app')
<script src="https://js.stripe.com/v3/"></script>

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-page">

    <div class="purchase-info">
    <!-- 商品情報 -->
    <div class="purchaseitem">
        <div class="item">
            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="item-img">
        </div>
        <div class="item-name">
            <h2>{{ $item->name }}</h2>
            <p>¥{{ number_format($item->price) }}</p>
        </div>
    </div>

    <!-- 支払方法 -->
    <div class="payment">
        <h2>支払い方法</h2>
        <div class="payment-form">
            <form id="payment-method-form" class="payment-method-form">
            @foreach ($paymentMethods as $paymentMethod)
                <label>
                    <input 
                        type="radio" 
                        name="payment_method" 
                        value="{{ $paymentMethod->name }}" 
                        {{ $loop->first ? 'checked' : '' }} 
                        onchange="updateSelectedPaymentMethod('{{ $paymentMethod->name }}')">
                    {{ $paymentMethod->name }}
                </label>
                <br>
            @endforeach
            </form>
        </div>
    </div>

    <!-- 住所変更リンク -->
    <div class="payment">
        <h2>配送先</h2>
        <a href="{{ route('address.change', ['item_id' => $item->id]) }}" class="btn-secondary">変更する</a>
    </div>

    </div>

    <div class="paymentcard">
        <!-- 確認カード -->
        <div class="paycard">
            <div class="card">
                <h3 class="cardh3">商品代金</h3>
                <p class="cardp">¥{{ number_format($item->price) }}</p>
            </div>

            <div class="card">
                <h3 class="cardh3">支払金額</h3>
                <p class="cardp">¥{{ number_format($item->price) }}</p>
            </div>

            <div class="card">
                <h3 class="cardh3">支払い方法</h3>
                <p id="selected-payment-method" class="cardp">{{ $paymentMethods->first()->name }}</p>
            </div>         
            
        </div>

        <!-- 購入ボタン -->
        <form id="payment-form" action="{{ route('complete_purchase', ['item_id' => $item->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" id="hidden-payment-method" value="{{ $paymentMethods->first()->name }}">
            <div id="card-element" style="display: none;"></div>
            <button type="submit" class="paybtn">購入する</button>
        </form>
    </div>
</div>




<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    const paymentMethodForm = document.getElementById('payment-method-form');
    const selectedPaymentMethod = document.getElementById('selected-payment-method');
    const cardElement = document.getElementById('card-element');
    const paymentForm = document.getElementById('payment-form');

    function updateSelectedPaymentMethod(paymentMethod) {
    document.getElementById('selected-payment-method').innerText = paymentMethod;
    document.getElementById('hidden-payment-method').value = paymentMethod;

    // クレジットカード選択時にStripe用のフォームを表示
    if (paymentMethod === 'クレジットカード') {
        document.getElementById('card-element').style.display = 'block';
    } else {
        document.getElementById('card-element').style.display = 'none';
    }
}
</script>
@endsection
