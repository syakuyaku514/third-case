<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>管理者登録</title>
</head>
<body>
    <div class="homevar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg')}}" alt="メールアイコン"  class="homevarimg">
        </a>
    </div>

    <div class="loginform">
    <h1>管理者登録フォーム</h1>
    <div>
        @if ($errors->any())
        <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="registerli">{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
    </div>
    <form action="{{ route('admin.register.submit') }}" method="POST" class="form" novalidate>
    @csrf
    <div class="formlabel">
        <label for="name" class="inptlabel">名前:</label>
        <input type="text" name="name" id="name" class="inputfom" value="{{ old('name') }}" required>
    </div>
    <div class="formlabel">
        <label for="email" class="inptlabel">メールアドレス:</label>
        <input type="email" name="email" id="email" class="inputfom" value="{{ old('email') }}" required>
    </div>
    <div class="formlabel">
        <label for="password" class="inptlabel">パスワード:</label>
        <input type="password" name="password" id="password" class="inputfom" required>
    </div>
    <div class="formlabel">
        <label for="password_confirmation" class="inptlabel">パスワード確認:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="inputfom" required>
    </div>
    <button type="submit" class="loginbtn">登録</button>
    </form>
    </div>
</body>
</html>
