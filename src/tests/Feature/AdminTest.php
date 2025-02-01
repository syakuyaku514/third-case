<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class AdminTest extends TestCase
{
    use WithFaker;

    public function  test_admin_registration_and_login()
    {
                
        // ランダムな名前とメールアドレスを生成
        $adminName = $this->faker->name();
        $adminEmail = $this->faker->unique()->safeEmail();
        $adminPassword = 'password123';

        // 管理者登録リクエストを送信
        $adminResponse = $this->post('/admin/register', [
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => $adminPassword,
            'password_confirmation' => $adminPassword,
        ]);

        // 正しいリダイレクト先を確認
        $adminResponse->assertRedirect(route('admin.index'));


        // 登録された管理者を取得
        $admin = Admin::where('email', $adminEmail)->first();
        $this->assertNotNull($admin, '管理者が登録されていません');

        // ログインリクエスト
        $response = $this->post('/admin/login', [
            'email' => $adminEmail,
            'password' => $adminPassword,
        ]);
        
        // リダイレクト先を確認（例: ダッシュボードにリダイレクト）
        $response->assertRedirect('/admin/index');

        // ログイン状態を確認
        $this->assertAuthenticatedAs($admin, 'admin');
        

    }
}
