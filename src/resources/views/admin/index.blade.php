<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
</head>
<body>
    <h1>管理者画面</h1>

    <!-- ログアウトボタン -->
    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
    @csrf
    @method('POST')
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>

    <!-- ステータスメッセージ -->
    @if (session('status'))
    <p style="color: green;">{{ session('status') }}</p>
    @endif

    <!-- ユーザー一覧 -->
    <h2>ユーザー一覧</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>作成日</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <!-- ユーザー削除ボタン -->
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>コメント一覧</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ユーザーID</th>
                <th>商品ID</th>
                <th>コメント</th>
                <th>作成日</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user_id }}</td>
                    <td>{{ $comment->item_id }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <!-- コメント削除ボタン -->
                       <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                       </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h2>メール送信</h2>
    <form action="{{ route('admin.sendEmail') }}" method="POST">
    @csrf
    <label for="user_id">ユーザー:</label>
    <select name="user_id" id="user_id" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select>

    <label for="subject">件名:</label>
    <input type="text" id="subject" name="subject" required>

    <label for="message">メッセージ:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">送信</button>
    </form>

</body>
</html>
