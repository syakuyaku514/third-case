<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;


class UserTest extends TestCase
{
    use WithFaker;

    public function test_user_registration_login_and_logout()
    {
        // 1. ユーザー登録のテスト
        $email = $this->faker->unique()->safeEmail();
        $password = 'password123';

        $response = $this->post('/register', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);

        // 2. 登録したユーザーでログインのテスト
        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

        // 3. ログインユーザーが商品を作成
        $itemData = [
            'user_id' => $user->id,
            'condition_id' => 1, // 任意の条件ID
            'name' => 'テスト商品',
            'brandname' => 'テストブランド',
            'price' => 1000,
            'description' => 'これはテスト商品の説明です。',
            'image' => 'test_image.jpg', // 仮の画像パス
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $item = Item::create($itemData);

        // 3. お気に入り登録
        $response = $this->post(route('favorite.toggle'), [
            'item_id' => $item->id,
        ]);

        // 4. お気に入りが登録されたことを確認
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        // 5. 同じリクエストを送信してお気に入り登録を解除
        $response = $this->post(route('favorite.toggle'), [
            'item_id' => $item->id,
        ]);

        // 6. お気に入りが削除されたことを確認
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        // 7. コメントの追加テスト
        $commentText = 'これはテストコメントです。';

        $response = $this->post(route('item.comment.store', $item->id), [
            'comment' => $commentText,
        ]);

        // コメント投稿後のリダイレクト先を確認
        $response->assertRedirect(route('item.comment', ['id' => $item->id]));


        // 8.ログイン後にマイページにアクセス
        $response = $this->actingAs($user)->get(route('mypage'));
        $response->assertStatus(200);
        $response->assertViewIs('mypage');
        $response->assertViewHas('profile', $user->profile);
        $response->assertViewHas('listedItems');
        $response->assertViewHas('purchasedItems');

        // 9. ログアウトのテスト
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    
    

}
