<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterAdminRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Comment;
use App\Models\Admin;


class AdminController extends Controller
{

    // 管理者登録フォームの表示
    public function showRegisterForm()
    {
        return view('admin.register'); // admin/register.blade.php を表示
    }

    // 管理者登録処理
    public function registerAdmin(RegisterAdminRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 管理者登録
        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.index')->with('status', '新しい管理者を登録しました。');
    }

    // 管理者ログイン画面の表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 管理者ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index')->with('status', 'ログインに成功しました！');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
    
    // ダッシュボードの表示
    public function index()
    {
        // 全ユーザーと全コメントを取得
        $users = User::all();
        $users = User::with('profile')->get();
        $comments = Comment::all();

        return view('admin.index', compact('users','comments'));
    }

    // 管理者ログアウト
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login'); // ログイン画面にリダイレクト
    }

    // メール送信表示
    public function showSendEmailForm()
    {
    // ユーザーリストを取得してビューに渡す
    $users = User::all();
    return view('admin.send_email_form', compact('users'));
    }

    // メール送信処理
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // ユーザー情報を取得
        $user = User::findOrFail($validated['user_id']);

        // メール送信
        Mail::raw($validated['message'], function ($message) use ($user, $validated) {
            $message->to($user->email)
                    ->subject($validated['subject']);
        });

        return redirect()->route('admin.sendEmailForm')->with('status', 'メールを送信しました。');
    }

    public function deleteUser(User $user)
    {
        // ユーザーを削除
        $user->delete();

        // 管理者画面にリダイレクト
        return redirect()->route('admin.index')->with('status', 'ユーザーを削除しました。');
    }

    public function deleteComment(Comment $comment)
    {
        // コメントを削除
        $comment->delete();

        // 管理者画面にリダイレクト
        return redirect()->route('admin.index')->with('status', 'コメントを削除しました。');
    }

}
