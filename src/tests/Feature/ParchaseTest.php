<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;

class ParchaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_item_is_marked_as_after_parchase()
    {
        $user = User::factory()->create();

        $item = Item::create([
            'name' => '腕時計',
            'price' => 15000,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュな腕時計',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => User::factory()->create()->id,
        ]);
        
        $response = $this->actingAs($user)
             ->get('/purchase/success/' . $item->id);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'is_sold' => true,
            'purchaser_id' => $user->id,
        ]);
    }

    public function test_parchased_item_is_displayed_in_mypage()
    {
        $user = User::factory()->create();

        $item = Item::create([
            'name' => '購入商品',
            'price' => 15000,
            'brand' => 'テスト',
            'description' => 'テスト',
            'img_url' => 'test.png',
            'condition' => '良好',
            'user_id' => User::factory()->create()->id,
            'is_sold' => true,
            'purchaser_id' => $user->id,
        ]);
        
        $response = $this->actingAs($user)
                         ->get('/mypage?page=buy');

        $response->assertSee('購入商品');
    }
}
