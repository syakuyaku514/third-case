<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>管理者ログイン</title>
</head>
<body>
    <div class="homevar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg')}}" alt="メールアイコン"  class="homevarimg">
        </a>
    </div>

    <div class="loginform">
    <h1>管理者ログインフォーム</h1>
    <!-- ステータスメッセージ -->
    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    <!-- エラーメッセージ -->
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST"  class="form" novalidate>
        @csrf
        <div class="formlabel">
            <label for="email" class="inptlabel">メールアドレス:</label>
            <input type="email" name="email" id="email" class="inputfom" value="{{ old('email') }}" required>
            <!-- 入力エラーの表示 -->
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="formlabel">
            <label for="password" class="inptlabel">パスワード:</label>
            <input type="password" name="password" id="password" class="inputfom" required>
            <!-- 入力エラーの表示 -->
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="loginbtn">ログイン</button>
    </form>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    </div>
</body>
</html>
