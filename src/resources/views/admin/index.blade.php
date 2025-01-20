<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
    <table class="usertable">
        <thead>
            <tr class="usertr">
                <th class="userth1">ID</th>
                <th class="userth1">名前</th>
                <th class="userth2">メールアドレス</th>
                <th class="userth2">作成日</th>
                <th class="userth2">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="userth1">{{ $user->id }}</td>
                    <td class="userth1">
                        @if ($user->profile)
                            {{ $user->profile->name }}
                        @else
                            プロフィール未設定
                        @endif
                    </td>
                    <td class="userth2">{{ $user->email }}</td>
                    <td class="userth2">{{ $user->created_at }}</td>
                    <td class="userth3">
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
    <table class="usertable">
        <thead>
            <tr class="usertr">
                <th class="userth1">ID</th>
                <th class="userth1">ユーザーID</th>
                <th class="userth1">商品ID</th>
                <th class="userth2">コメント</th>
                <th class="userth2">作成日</th>
                <th class="userth2">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td class="userth1">{{ $comment->id }}</td>
                    <td class="userth1">{{ $comment->user_id }}</td>
                    <td class="userth1">{{ $comment->item_id }}</td>
                    <td class="userth2">{{ $comment->comment }}</td>
                    <td class="userth2">{{ $comment->created_at }}</td>
                    <td class="userth3">
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
            <option value="{{ $user->id }}">
                @if ($user->profile && isset($user->profile->name))
                    {{ $user->profile->name }} ({{ $user->email }})
                @else
                    プロフィール未設定 ({{ $user->email }})
                @endif
            </option>
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
