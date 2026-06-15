<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\comment;
use App\Models\Item;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_comment()
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
        
        $this->actingAs($user)
             ->post('/item/' . $item->id . '/comment', [
                'content' => 'テストコメント'
             ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'テストコメント',
        ]);
    }

    public function test_guest_cannot_comment()
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

        $response = $this->post('/item/' . $item->id . '/comment', [
            'content' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_comment_is_required()
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
                         ->post('/item/' . $item->id . '/comment', [
                            'content' => '',
                         ]);
        $response->assertSessionHasErrors('content');
        
        $this->assertEquals(
            'コメントを入力してください',
            session('errors')->first('content')
        );
    }

    public function test_comment_must_be_within_255_characters()
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
                         ->post('/item/' . $item->id . '/comment', [
                            'content' => str_repeat('a', 256),
                         ]);
        $response->assertSessionHasErrors('content');
        
        $this->assertEquals(
            '255文字以内で入力してください',
            session('errors')->first('content')
        );
    }

}
