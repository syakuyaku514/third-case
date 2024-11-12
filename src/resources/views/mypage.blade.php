@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <img src="{{ $profile && $profile->image ? asset('storage/' . $profile->image) : asset('images/default-icon.png') }}" alt="プロフィールアイコン">
    <p>{{ $profile ? $profile->name : 'ゲストユーザー' }}</p>

    <button onclick="location.href='{{ route($hasProfile ? 'profile.edit' : 'profile.create') }}'">
        {{ $hasProfile ? 'プロフィールを編集' : 'プロフィールを登録' }}
    </button>

    <button>出品した商品</button>
    <!-- ここに商品一覧 -->
    <button>購入した商品</button>
    <!-- ここに商品一覧 -->
</div>
@endsection