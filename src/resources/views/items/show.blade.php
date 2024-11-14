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
        <a href="{{ route('purchase', ['item_id' => $item->id]) }}" class="purchase-button">
            購入する
        </a>

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