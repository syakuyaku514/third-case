@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile-edit">
    <h2>住所の変更</h2>

    <form action="{{ route('address.update', ['item_id' => $item_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post" class="formlabel">住所</label>
            <input type="text" name="post" id="post" class="forminput" placeholder="{{ $profile->post }}" value="{{ old('post', $profile->post) }}">
        </div>

        <div class="form-group">
            <label for="address" class="formlabel">住所</label>
            <input type="text" name="address" id="address" class="forminput" placeholder="{{ $profile->address }}" value="{{ old('address', $profile->address) }}">
        </div>

        <div class="form-group">
            <label for="building" class="formlabel">建物名</label>
            <input type="text" name="building" id="building" class="forminput" placeholder="{{ $profile->building }}" value="{{ old('building', $profile->building) }}">
        </div>

        <button type="submit" class="updatebtn">更新する</button>
    </form>
</div>
@endsection