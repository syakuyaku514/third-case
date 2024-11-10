@extends('layouts.app')

@section('content')
<div class="container">
    <h2>住所の変更</h2>

    <form action="{{ route('address.update', ['item_id' => $item_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post">住所</label>
            <input type="text" name="post" id="post" class="form-control" placeholder="{{ $profile->post }}" value="{{ old('post', $profile->post) }}">
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="{{ $profile->address }}" value="{{ old('address', $profile->address) }}">
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" class="form-control" placeholder="{{ $profile->building }}" value="{{ old('building', $profile->building) }}">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection