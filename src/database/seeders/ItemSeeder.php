<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Item::create([
        'user_id' => 1,
         'name' => '腕時計',
         'price' => 15000,
         'brand' => 'Rolax',
         'description' => 'スタイリッシュな腕時計',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
         'condition' => '良好'
    ]);

       Item::create([
        'user_id' => 1,
         'name' => 'HDD',
         'price' => 5000,
         'brand' => '西芝',
         'description' => '高速で信頼性の高いハードディスク',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
         'condition' => '目立った傷や汚れなし'
    ]);
        Item::create([
         'user_id' => 1,
         'name' => '玉ねぎ３束',
         'price' => 300,
         'brand' => 'なし',
         'description' => '新鮮な玉ねぎ３束のセット',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
         'condition' => 'やや傷や汚れあり'
    ]);
        Item::create([
         'user_id' => 1,
         'name' => '革靴',
         'price' => 4000,
         'brand' => '',
         'description' => 'クラシックなデザインの革靴',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
         'condition' => '状態が悪い'
    ]);  
        Item::create([
           'user_id' => 1,
         'name' => 'ノートPC',
         'price' => 45000,
         'brand' => '',
         'description' => '高性能なノートパソコン',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
         'condition' => '良好'
    ]);
        Item::create([
         'user_id' => 1,
         'name' => 'マイク',
         'price' => 8000,
         'brand' => 'なし',
         'description' => '高音質のレコーディング用マイク',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
         'condition' => '目立った傷や汚れなし'
    ]);  
        Item::create([
         'user_id' => 1,
         'name' => 'ショルダーバッグ',
         'price' => 3500,
         'brand' => '',
         'description' => 'おしゃれなショルダーバッグ',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
         'condition' => 'やや傷や汚れあり'
    ]);
        Item::create([
         'user_id' => 1,
         'name' => 'タンブラー',
         'price' => 500,
         'brand' => 'なし',
         'description' => '使いやすいタンブラー',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
         'condition' => '状態が悪い'
    ]); 
        Item::create([
         'user_id' => 2,
         'name' => 'コーヒーミル',
         'price' => 4000,
         'brand' => 'Starbacks',
         'description' => '手動のコーヒーミル',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
         'condition' => '良好'
    ]);
        Item::create([
         'user_id' => 2,
         'name' => 'メイクセット',
         'price' => 2500,
         'brand' => '',
         'description' => '便利なメイクアップセット',
         'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
         'condition' => '目立った傷や汚れなし'
    ]);

    Item::find(1)->categories()->attach([1,12]);
    Item::find(2)->categories()->attach([2]);
    Item::find(3)->categories()->attach([10]);
    Item::find(4)->categories()->attach([1,5]);
    Item::find(5)->categories()->attach([2]);
    Item::find(6)->categories()->attach([2]);
    Item::find(7)->categories()->attach([1,5]);
    Item::find(8)->categories()->attach([10]);
    Item::find(9)->categories()->attach([10]);
    Item::find(10)->categories()->attach([8]);
    }
}
