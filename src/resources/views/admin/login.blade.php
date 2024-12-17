<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>
<body>
    <h1>管理者ログインフォーム</h1>
    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>
</html>
