<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use App\Models\Category;
use App\Models\Comment;

class ItemDatailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_item_datail_is_displayed()
    {
        $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => User::factory()->create()->id,
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);

        $response->assertSee('腕時計');
        $response->assertSee('Rolax');
        $response->assertSee('¥15,000');
        $response->assertSee('スタイリッシュな腕時計');
        $response->assertSee('良好');
        }

        public function test_multiple_categories_are_displayed()
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
        
        $category1 = Category::create([
            'name' =>'ファッション',
        ]);

        $category2 = Category::create([
            'name' => '家電',
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('ファッション');
        $response->assertSee('家電');
    }

    public function test_comment_is_displayed()
    {
        $user = User::factory()->create([
           'name' => 'テストユーザー',
        ]);

            $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => $user->id,
        ]);

        comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'テストコメント',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('テストユーザー');
        $response->assertSee('テストコメント');
    }

    public function test_item_image_is_displayed()
    {
        $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => User::factory()->create()->id,
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('test.png');
    }

    public function test_like_count_is_displayed()
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

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('1');
    }

    public function test_comment_count_is_displayed()
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

        comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'コメント1',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('1');
    }


}   


        
