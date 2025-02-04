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
        <div class="profileimage">
            @if($profile && $profile->image)
                <img src="{{ asset('storage/' . $profile->image) }}" alt="プロフィール画像" class="imgprofile">
            @endif
            <label for="image" class="imgbtn">
                画像を選択する
            </label>
            <input type="file" name="image" id="image"class="imginput forminput">
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
            
        </div>

        <!-- ユーザー名 -->
        <div>
            <label for="name" class="formlabel">ユーザー名</label>
            <input type="text" name="name" id="name" class="forminput" value="{{ old('name', $profile->name ?? '') }}" required>
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 郵便番号 -->
        <div>
            <label for="post" class="formlabel">郵便番号</label>
            <input type="text" name="post" id="post" class="forminput" value="{{ old('post', $profile->post ?? '') }}">
            @error('post')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 住所 -->
        <div>
            <label for="address" class="formlabel">住所</label>
            <input type="text" name="address" id="address" class="forminput" value="{{ old('address', $profile->address ?? '') }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 建物名 -->
        <div>
            <label for="building" class="formlabel">建物名</label>
            <input type="text" name="building" id="building" class="forminput" value="{{ old('building', $profile->building ?? '') }}">
            @error('building')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 更新ボタン -->
        <button type="submit" class="updatebtn">{{ $profile ? '更新する' : '作成する' }}</button>
    </form>
</div>
@endsection
