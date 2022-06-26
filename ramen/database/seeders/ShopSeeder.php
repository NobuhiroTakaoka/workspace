<?php

namespace Database\Seeders;

use App\Models\Shops;  // 追記
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 店舗レコードを登録
        Shops::factory()->count(10)->create();  // 追記
    }
}
