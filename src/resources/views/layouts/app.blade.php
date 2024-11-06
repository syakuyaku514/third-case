<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('css')
</head>

<body>
    <div class="homevar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg')}}" alt="メールアイコン" width="200" height="80">
        </a>
        <p>ここに検索ボックス</p>
        <div>
            @guest
                <a href="/login" class="varbtn">ログイン</a>
            @endguest
        </div>

        <div>
            @guest
                <a href="/register" class="varbtn">会員登録</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
                <a href="{{ route('mypage')}}" class="varbtn">マイページ</a>
            @endguest
        </div>
        <div>
            <button>出品</button>
        </div>
    </div>

    <main class="appmain">
        @yield('content')
    </main>
</body>

</html>