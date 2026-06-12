<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_liked_items_are_displayed()
    {
       $user = User::factory()->create();
       $otherUser = User::factory()->create();

       $likedItem = Item::create([
          'name' => 'いいね商品',
          'price' => 1000,
          'brand' => 'テスト',
          'description' => 'テスト',
          'img_url' => 'test.png',
          'condition' => '良好',
          'user_id' => $user->id,
       ]);

       $notLikedItem = Item::create([
          'name' => 'いいねしてない商品',
          'price' => 1000,
          'brand' => 'テスト',
          'description' => 'テスト',
          'img_url' => 'test.png',
          'condition' => '良好',
          'user_id' => $user->id,
        ]);

        Like::create([
          'user_id' => $user->id,
          'item_id' => $likedItem->id,
        ]);

        $response = $this->actingAs($user)
                     ->get('/mylist');

        $response->assertSee('いいね商品');
        $response->assertDontSee('いいねしてない商品');
    }

    public function test_sold_item_is_displayd_in_mylist()
    {
        $user = User::factory()->create();

        $item = Item::create([
          'name' => '売却済商品',
          'price' => 1000,
          'brand' => 'テスト',
          'description' => 'テスト',
          'img_url' => 'test.png',
          'condition' => '良好',
          'user_id' => $user->id,
          'is_sold' => 1,
       ]);

       Like::create([
        'user_id' => $user->id,
        'item_id' => $item->id,
       ]);

       $response = $this->actingAs($user)
                       ->get('/mylist');
                       
       $response->assertSee('sold');
    }   

    public function test_guest_cannot_see_liked_items()
    {
        $response = $this->get('/mylist');

        $response->assertStatus(200);

        $response->assertDontSee('いいね商品');
    }
}
