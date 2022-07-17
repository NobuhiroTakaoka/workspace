<?php

namespace Database\Factories;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reviews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->unique()->numberBetween(1, 10),  // 店舗ID
            'user_id' => (Integer)1,  // ユーザID
            'menu_title' => $this->faker->realText(30),  // メニュー（タイトル）
            'category' => $this->faker->randomElement(['ラーメン', 'つけ麺', 'まぜそば', 'その他の麺']),  // カテゴリ
            'soup' => $this->faker->randomElement(['醤油系', '味噌系', '塩系', '豚骨系', '魚介系', 'その他スープ']),  // スープ
            'points' => $this->faker->numberBetween(0, 100),  // 点数
            'image_path' => 'jJCxVONJj3VTRVUwMyKgtkbcBOw7zTKngE8AdvQI.jpg',  // メニュー画像
            'comment' => $this->faker->realText(300),  // コメント
        ];
    }
}
