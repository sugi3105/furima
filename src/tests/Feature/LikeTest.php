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

    public function test_search_keyword_is_kept_in_mylist()
    {
        $user = User::factory()->create();

        $item1 = Item::create([
            'name' => '腕時計',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        $item2 = Item::create([
            'name' => 'HDD',
            'price' => 1000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item1->id,
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item2->id,
        ]);

        $response = $this->actingAs($user)
                         ->get('/mylist?keyword=腕');

        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
    }

    public function test_user_can_like_item()
    {
        $user = User::factory()->create();

            $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
                         ->post('/item/' . $item->id . '/like');

        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_can_unlike_item()
    {
        $user = User::factory()->create();

        $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->actingAs($user)
             ->post('/item/' . $item->id . '/like');

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}
