<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録</title>
</head>
<body>
    <h1>管理者登録フォーム</h1>
    <div>
        @if ($errors->any())
        <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
    </div>
    <form action="{{ route('admin.register.submit') }}" method="POST" novalidate>
    @csrf
    <div>
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="email">メールアドレス:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="password_confirmation">パスワード確認:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <button type="submit">登録</button>
    </form>
</body>
</html>
