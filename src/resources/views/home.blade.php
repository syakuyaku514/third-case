@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<div class="tab-container">
    <!-- タブボタン -->
    <div class="tabs">
        <form method="GET" action="{{ route('home') }}">
            <input type="hidden" name="tab" value="recommended">
            <button type="submit" class="tab-button {{ request('tab', 'recommended') === 'recommended' ? 'active' : '' }}">
                おすすめ
            </button>
        </form>
        <form method="GET" action="{{ route('home') }}">
            <input type="hidden" name="tab" value="mylist">
            <button type="submit" class="tab-button {{ request('tab') === 'mylist' ? 'active' : '' }}">
                マイリスト
            </button>
        </form>
    </div>

    <!-- 商品リスト表示 -->
    @if(request('tab', 'recommended') === 'recommended')
        <div class="item-list">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ url('/item/' . $item->id) }}">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="itemimg">
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <!-- お気に入りリスト表示 -->
    @if(request('tab') === 'mylist')
        <div class="item-list">
            @if($favoriteItems->isEmpty())
                <p>お気に入り登録した商品がありません。</p>
            @else
                @foreach($favoriteItems as $item)
                    <div class="item">
                        <a href="{{ url('/item/' . $item->id) }}">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}"  class="itemimg">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>

@endsection
