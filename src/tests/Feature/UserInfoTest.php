<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class UserInfoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_name_is_displayed()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー'
        ]);

        $response = $this->actingAs($user)
                         ->get('/mypage');

        $response->assertStatus(200);

        $response->assertSee('テストユーザー');
    }

    public function test_sell_item_are_displayed()
    {
        $user = User::factory()->create();

        $item = Item::create([
            'name' => '出品商品',
            'price' => 15000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);
        
        $response = $this->actingAs($user)
                         ->get('/mypage');

        $response->assertStatus(200);
        $response->assertSee('出品商品');
    }

    public function test_profile_image_is_displayed()
    {
        $user = User::factory()->create([
            'profile_image' => 'profile/test.png',
        ]);

        $response = $this->actingAs($user)
                        ->get('mypage');

        $response->assertStatus(200);
        $response->assertSee('storage/profile/test.png');

    }
}
