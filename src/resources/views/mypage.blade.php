@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <img src="" alt="プロフィールアイコン">
    <p>ユーザー名表示</p>

    <!-- ボタンのラベルを条件によって変更 -->
    <button onclick="location.href='{{ route($hasProfile ? 'profile.edit' : 'profile.create') }}'">
        {{ $hasProfile ? 'プロフィールを編集' : 'プロフィールを登録' }}
    </button>

    <button>出品した商品</button>
    <!-- ここに商品一覧 -->
    <button>購入した商品</button>
    <!-- ここに商品一覧 -->
</div>
@endsection