<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class SellTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_item_can_be_registered()
{
    Storage::fake('public');

    $user = User::factory()->create();
    $category = Category::create([
        'name'=> 'ファッション',
    ]);

    $file = UploadedFile::fake()->create('test.jpg');

    $this->actingAs($user)->post('/sell', [
        'name' => 'テスト商品',
        'price' => 3000,
        'brand' => 'Nike',
        'description' => 'テスト説明',
        'condition' => '良好',
        'categories' => [$category->id],
        'img_url' => $file,
    ]);

    $this->assertDatabaseHas('items', [
        'name' => 'テスト商品',
        'brand' => 'Nike',
        'description' => 'テスト説明',
        'condition' => '良好',
        'price' => 3000,
    ]);
}
}
