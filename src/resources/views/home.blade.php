<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>ここにロゴ</h1>
    <p>ここに検索ボックス</p>
    <div>
        <a href="/login">ログイン</a>
    </div>
    <div>
        <a href="/register">会員登録</a>
    </div>
    <div>
        <button>出品</button>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>