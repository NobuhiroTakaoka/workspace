<?php

namespace Database\Seeders;

use App\Models\Reviews;  // 追記
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // レビューレコードを登録
        Reviews::factory()->count(10)->create();  // 追記
    }
}
