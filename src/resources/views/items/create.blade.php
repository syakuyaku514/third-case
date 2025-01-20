@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile-edit">
    <h1>商品の出品</h1>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 各フォームフィールド -->
        <p class="goodsimage">商品画像</p>
        <div class="imageform">
            <label for="image" class="file-label">画像を選択する</label>
            <input type="file" name="image" class="file-input" id="image" required>
        </div>

        <h2 class="title">商品の詳細</h2>
        <!-- カテゴリー -->
        <label class="categorylabel">カテゴリー</label>
        <div class="categorycheck">
            @foreach($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <!-- 商品の状態 -->
        <label for="condition" class="categorylabel">商品の状態</label>
        <select name="condition_id" id="condition" class="conditionselect" required>
            <option>選択してください</option>
            @foreach($conditions as $condition)
                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
            @endforeach
        </select>

        <h2 class="title">商品名と説明</h2>
        <div class="product">
            <label for="name" class="categorylabel">商品名</label>
            <input type="text" name="name" id="name" required>

            <label for="brandname" class="categorylabel">ブランド名</label>
            <input type="text" name="brandname">

            <!-- <label for="color">カラー</label>
            <input type="text" name="color"> -->

            <label for="description" class="categorylabel">商品の説明</label>
            <textarea name="description" required></textarea>
        </div>

        <h2 class="title">販売価格</h2>
        <div class="product">
            <label for="price" class="categorylabel">販売価格</label>
            <input type="number" name="price" placeholder="￥" required>
        </div>

        <button type="submit" class="updatebtn">出品する</button>
    </form>
</div>
@endsection