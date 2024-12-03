@extends('layouts.app')
<script src="https://js.stripe.com/v3/"></script>

@section('content')
<div class="purchase-page">
    <h1>購入手続き</h1>

    <!-- 商品情報 -->
    <div class="item-image">
        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}">
    </div>
    <div class="item-name">
        <h2>{{ $item->name }}</h2>
    </div>
    <div class="item-price">
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 支払方法 -->
<div>
    <h2>支払方法</h2>
    <form id="payment-method-form">
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

<!-- 確認カード -->
<div>
    <h3>支払方法</h3>
    <p id="selected-payment-method">{{ $paymentMethods->first()->name }}</p>
</div>

<!-- 購入ボタン -->
<form id="payment-form" action="{{ route('complete_purchase', ['item_id' => $item->id]) }}" method="POST">
    @csrf
    <input type="hidden" name="payment_method" id="hidden-payment-method" value="{{ $paymentMethods->first()->name }}">
    <div id="card-element" style="display: none;"></div>
    <button type="submit" class="purchase-button">購入する</button>
</form>
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
