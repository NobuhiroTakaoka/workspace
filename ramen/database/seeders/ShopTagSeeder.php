<?php

namespace Database\Seeders;

use App\Models\ShopTags;  // 追記
use Illuminate\Database\Seeder;

class ShopTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 店舗タグレコードを登録
        ShopTags::factory()->count(10)->create();  // 追記
    }
}
