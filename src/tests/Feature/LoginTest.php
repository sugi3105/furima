<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_email_is_required()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertEquals(
            'メールアドレスを入力してください',
            session('errors')->first('email')
        );
    }

     public function test_password_is_required()
    {
        $response = $this->post('/login', [
            'email' => 'test@ezweb.ne.jp',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');

        $this->assertEquals(
            'パスワードを入力してください',
            session('errors')->first('password')
        );
    }
     public function test_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'testeee@ezweb.ne.jp',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertEquals(
            'ログイン情報が登録されていません',
            session('errors')->first('email')
        );
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
    ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
    ]);

        $response->assertRedirect();
        $this->assertAuthenticated();
}
}
