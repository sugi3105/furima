<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class AddressTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_shipping_address_can_be_update()
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
             ->post('/purchase/address/' . $item->id, [
                 'postcode' => '630-0000',
                 'address' => '奈良県奈良市',
                 'building' => '',
              ]);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'shipping_address' => '奈良県奈良市',
        ]);
    }

    public function test_updated_address_is_displayed_on_purchase_page()
    {

        $user = User::factory()->create([
            'postcode' => '6300000',
            'address' => '奈良県奈良市',
            'building' => 'テストマンション',
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

        $response = $this->actingAs($user)
                         ->get('/purchase/' . $item->id);

        $response->assertSee('奈良県奈良市');
    }
}
