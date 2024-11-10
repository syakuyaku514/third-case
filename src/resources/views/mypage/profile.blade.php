@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile-edit">
    <h1>プロフィール設定</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ $profile ? route('profile.update') : route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            @if($profile)
                @method('PATCH')  <!-- 更新用 -->
            @endif

        <!-- プロフィール画像 -->
        <div>
            <label for="image">画像を選択する</label>
            <input type="file" name="image" id="image">
            @if($profile && $profile->image)
                <img src="{{ asset('storage/' . $profile->image) }}" alt="プロフィール画像" style="max-width: 100px;">
            @endif
        </div>

        <!-- ユーザー名 -->
        <div>
            <label for="name">ユーザー名</label>
            <input type="text" name="name" id="name" value="{{ old('name', $profile->name ?? '') }}" required>
        </div>

        <!-- 郵便番号 -->
        <div>
            <label for="post">郵便番号</label>
            <input type="text" name="post" id="post" value="{{ old('post', $profile->post ?? '') }}">
        </div>

        <!-- 住所 -->
        <div>
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ old('address', $profile->address ?? '') }}">
        </div>

        <!-- 建物名 -->
        <div>
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ old('building', $profile->building ?? '') }}">
        </div>

        <!-- 更新ボタン -->
        <button type="submit">{{ $profile ? '更新する' : '作成する' }}</button>
    </form>
</div>
@endsection
