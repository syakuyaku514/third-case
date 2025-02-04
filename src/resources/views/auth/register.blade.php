<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Register</title>
</head>
<body>
    <div class="homevar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg')}}" alt="メールアイコン"  class="homevarimg">
        </a>
    </div>

    <div class="loginform">
        <h1>会員登録</h1>
        @if ($errors->any())
            <div>
                <ul class="loginfomul">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf
            <div class="formlabel">
                <label for="email" class="inptlabel">メールアドレス</label>
            <input name="email" type="email" class="inputfom" value="{{ old('email') }}"/>
            </div>
            <div class="formlabel">
                <label for="email" class="inptlabel">パスワード</label>
                <input name="password" class="inputfom" type="password"/>
            </div>
            <div>
                <button type="submit" class="loginbtn">登録する</button>
            </div>
            <div>
                <a href="/login" class="loginlnk">ログインはこちら</a>
            </div>
        </form> 
    </div>   
</body>
</html>