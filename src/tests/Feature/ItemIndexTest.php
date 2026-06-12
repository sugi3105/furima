<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;


class ItemIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void/
     */
    public function test_all_item_are_displayed()
    {
    
       $response = $this->get('/');

       $response->assertStatus(200);
       $response->assertSee('腕時計');
    }

    public function test_sold_item_are_displayed()
    {
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

}
