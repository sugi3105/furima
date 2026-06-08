<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_name_is_required()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');

        $this->assertEquals(
            'お名前を入力してください',
            session('errors')->first('name')
        );
    }

    public function test_email_is_required()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertEquals(
            'メールアドレスを入力してください',
            session('errors')->first('email')
        );
    }

    public function test_password_is_required()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@ezweb.ne.jp',
            'password' => '',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('password');

        $this->assertEquals(
            'パスワードを入力してください',
            session('errors')->first('password')
        );
    }

    public function test_password_must_be_at_least_8_characters()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@ezweb.ne.jp',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertSessionHasErrors('password');

        $this->assertEquals(
            'パスワードは8文字以上で入力してください',
            session('errors')->first('password')
        );
    }

    public function test_password_comfirmation_must_match()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@ezweb.ne.jp',
            'password' => 'password12',
            'password_confirmation' => 'password1',
        ]);

        $response->assertSessionHasErrors('password');

        $this->assertEquals(
            'パスワードと一致しません',
            session('errors')->first('password')
        );
    }

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@ezweb.ne.jp',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users',[
            'email' => 'test@ezweb.ne.jp',
        ]);

        $response->assertRedirect('/email/verify');
    }


}
