<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_profile_can_be_updated()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/mypage/profile', [
                'name' => '山田太郎',
                'postcode' => '123-4567',
                'address' => '奈良県奈良市',
             ]);
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => '山田太郎',
            'postcode' => '123-4567',
            'address' => '奈良県奈良市',
        ]);      
    }

    public function test_profile_image_can_be_updated()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $file = UploadedFile::fake()->create('test.png');

        $this->actingAs($user)
             ->post('/mypage/profile', [
                'name' => $user->name,
                'postcode' => '',
                'address' => '',
                'profile_image' => $file,
             ]);

        Storage::disk('public')->assertExists('profiles/' . $file->hashName());

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'profile_image' => 'profiles/' . $file->hashName(),
        ]);
    }
}
