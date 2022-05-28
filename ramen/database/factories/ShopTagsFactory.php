<?php

namespace Database\Factories;

use App\Models\ShopTags;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopTagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShopTags::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->unique()->numberBetween(61, 63),  // 店舗ID
            'tag_id' => $this->faker->numberBetween(1, 10),  // タグID
        ];
    }
}
