@extends('layouts.app')

@section('content')
<div class="sell-page">
    <h1>商品の出品</h1>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 各フォームフィールド -->
        <label for="image">商品画像</label>
        <input type="file" name="image" id="image" required>

        <!-- カテゴリー -->
        <label for="category">カテゴリー</label>
        <select name="category_id" id="category" required>
            <option value="">選択してください</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <!-- 商品の状態 -->
        <label for="condition">商品の状態</label>
        <select name="condition_id" id="condition" required>
            <option value="">選択してください</option>
            @foreach($conditions as $condition)
                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
            @endforeach
        </select>

        <label for="name">商品名</label>
        <input type="text" name="name" id="name" required>

        <label for="brandname">ブランド名</label>
        <input type="text" name="brandname">

        <label for="price">販売価格</label>
        <input type="number" name="price" required>

        <label for="color">カラー</label>
        <input type="text" name="color">

        <label for="description">商品の説明</label>
        <textarea name="description" required></textarea>

        <button type="submit">出品する</button>
    </form>
</div>
@endsection