@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypageprofile">
        <img src="{{ $profile && $profile->image ? asset('storage/' . $profile->image) : asset('images/default-icon.png') }}" alt="プロフィールアイコン" class="mypageimg">

        <p class="username">{{ $profile ? $profile->name : 'ゲストユーザー' }}</p> 

        <button onclick="location.href='{{ route($hasProfile ? 'profile.edit' : 'profile.create') }}'" class="profilebtn">
        {{ $hasProfile ? 'プロフィールを編集' : 'プロフィールを登録' }}
        </button>
    </div>
    <!-- タブボタン -->
    <div class="tabs">
        <form method="GET" action="{{ route('mypage') }}" class="tabform">
            <input type="hidden" name="tab" value="listed">
            <button type="submit" class="tab-button {{ request('tab', 'listed') === 'listed' ? 'active' : '' }}">
                出品した商品
            </button>
        </form>
        <form method="GET" action="{{ route('mypage') }}">
            <input type="hidden" name="tab" value="purchased">
            <button type="submit" class="tab-button {{ request('tab') === 'purchased' ? 'active' : '' }} tabpay">
                購入した商品
            </button>
        </form>
    </div>

    <!-- 出品した商品 -->
    @if(request('tab', 'listed') === 'listed')
        <div class="item-list">
            @if($listedItems->isEmpty())
                <p>出品した商品がありません。</p>
            @else
                @foreach($listedItems as $item)
                    <div class="item">
                        <a href="{{ url('/item/' . $item->id) }}">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="listimg">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    @endif

    <!-- 購入した商品 -->
@if(request('tab', 'listed') === 'purchased')
    <div class="item-list">
        @if($purchasedItems->isEmpty())
            <p>購入した商品がありません。</p>
        @else
            @foreach($purchasedItems as $item)
                <div class="item">
                    <a href="{{ url('/item/' . $item->id) }}">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default.png') }}" alt="{{ $item->name }}" class="itemimg">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
@endif


</div>
@endsection