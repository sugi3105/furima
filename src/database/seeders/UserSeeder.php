<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name' => 'test1',
        'email' => 'test1@test.com',
        'password' => Hash::make('password'),
        ]);

        User::create([
       'name' => 'test2',
       'email' => 'test2@test.com',
       'password' => Hash::make('password'),
        ]);
       }
}
