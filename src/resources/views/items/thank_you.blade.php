<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
    <title>Thank You</title>
</head>
<body>
    <div class="thanks">
        <h1>ご購入ありがとうございます！</h1>
        <p class="thankspay">購入手続きが完了しました。</p>
        <div class="home">
            <a href="{{ route('home') }}" class="thankshome">ホームに戻る</a>
        </div>
    </div>
</body>
</html>
