@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<div class="tab-container">
    <!-- タブボタン -->
    <div class="tabs">
        <button @click="showTab = 'recommended'" :class="{ active: showTab === 'recommended' }">おすすめ</button>
        <button @click="showTab = 'mylist'" :class="{ active: showTab === 'mylist' }">マイリスト</button>
    </div>

    <!-- 商品リスト表示 -->
    <div v-if="showTab === 'recommended'">
        <div class="item-list">
            @foreach($items as $item)
                <div class="item">
                    <a href="{{ url('/item/' . $item->id) }}">
                        <img src="{{ asset('img/商品写真.png') }}" alt="商品画像">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- お気に入りリスト表示 -->
    <div v-if="showTab === 'mylist'">
    </div>
</div>

@endsection