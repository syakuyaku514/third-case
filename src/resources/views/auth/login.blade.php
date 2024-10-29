<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>ログイン画面</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form  method="POST" action="/login">
        @csrf
        <div>
            <label for="email">メールアドレス</label>
            <input name="email" type="email" value="{{old('email')}}"/>
        </div>
        <div>
            <label for="password">パスワード</label>
            <input name="password" type="password" />
        </div>
        <div>
            <button type="submit">送信</button>
        </div>
    </form>
</body>
</html>