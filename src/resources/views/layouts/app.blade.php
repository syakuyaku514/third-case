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
            <img src="{{ asset('img/logo.svg')}}" alt="メールアイコン" class="homevarimg">
        </a>
        <div class="homevarsearch">
            <form action="{{ route('items.index') }}" method="GET" class="search-form">
                <input type="text" name="search" value="{{ old('search', $search ?? '') }}" class="search-box" placeholder="なにをお探しですか？">
            </form>
        </div>
        <div class="btn">
            @guest
                <a href="/login" class="varbtn">ログイン</a>
            @endguest
        </div>

        <div class="guestbtn">
            @guest
                <a href="/register" class="varbtn registerbtn">会員登録</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logoutbtn">ログアウト</button>
                </form>
                <a href="{{ route('mypage')}}" class="varbtn mypagebtn">マイページ</a>
            @endguest
        </div>
        <div class="btn">
            @auth
            <a href="{{ route('items.create') }}" class="varbtn">
                <button type="button" class="listingbtn">出品</button>
            </a>
            @else
            <a href="{{ route('login') }}" class="varbtn">
                <button type="button" class="listingbtn">出品</button>
            </a>
            @endauth
        </div>
    </div>

    <main class="appmain">
        @yield('content')
    </main>
</body>

</html>