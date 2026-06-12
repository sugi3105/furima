<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;


class ItemIndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void/
     */
    public function test_all_item_are_displayed()
    {
        $user = User::factory()->create();

        Item::create([
            'name' => '腕時計',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('腕時計');
    }

    public function test_sold_item_are_displayed()
    {
        $user = User::factory()->create();

        Item::create([
            'name' => '売却済商品',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
            'is_sold' => 1,
        ]);

        $response = $this->get('/');

        $response->assertSee('Sold');
    }  

    public function test_user_item_are_not_display()
    {
        $user = User::factory()->create();

        Item::create([
            'name' => '自分の商品',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertDontSee('自分の商品');
    }

    public function test_items_can_be_searched_by_name()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Item::create([
            'name' => '腕時計',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user1->id,
        ]);

        Item::create([
            'name' => 'HDD',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user2->id,
        ]);

        $response = $this->get('/?keyword=腕');

        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
    }
}
