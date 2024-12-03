@extends('layouts.app')

@section('content')
<div>
    <h1>購入が完了しました</h1>
    <p>商品: {{ $order->item->name }}</p>
    <p>支払い方法: {{ $order->payment->name }}</p>
    <a href="{{ route('home') }}">ホームに戻る</a>
</div>
@endsection
