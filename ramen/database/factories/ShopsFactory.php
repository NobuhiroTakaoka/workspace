<?php

namespace Database\Factories;

use App\Models\Shops;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shops::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => 1,
            'user_id_creater' => (Integer)1,
            // 'user_id_update' => 1,  // ユーザID
            'user_id_updater' => (Integer)1,
            'shop_name' => $this->faker->company(),  // 店名の代替（会社名）
            'shop_name_kana' => $this->faker->company(),  // 店名（ふりがな）の代替（会社名）
            'branch' => $this->faker->company(),  // 支店名の代替（会社名）
            'postcode' => $this->faker->postcode(),  // 郵便番号
            'address1' => $this->faker->prefecture(),  // 都道府県名
            'address2' => $this->faker->city(),  // 市区町村名
            'address3' => $this->faker->streetAddress(),  // 番地など
            'address4' => $this->faker->secondaryAddress(),  // 建物名・部屋番号など
            'map_lat' => $this->faker->latitude($min = -90, $max = 90),  // 緯度
            'map_long' => $this->faker->longitude($min = -180, $max = 180),  // 経度
            'phone_number1' => $this->faker->phoneNumber(),  // 電話番号１
            'phone_number2' => $this->faker->phoneNumber(),  // 電話番号２
            'opening_hour1' => $this->faker->time('H:i') . '～' . $this->faker->time('H:i'),  // 営業時間１
            'opening_hour2' => $this->faker->time('H:i') . '～' . $this->faker->time('H:i'),  // 営業時間２
            'holiday' => $this->faker->dayOfWeek(),  // 定休日（曜日）
            'seats' => $this->faker->randomNumber(2) . '席',  // 座席数
            'access' => $this->faker->city() . '駅より徒歩' . $this->faker->randomNumber(1) . '分',  // アクセス
            'parking' => $this->faker->randomNumber(1) . '台',  // 駐車場
            'official_site' => $this->faker->url(),  // 公式サイト
            'official_blog' => $this->faker->url(),  // 公式ブログ
            'facebook' => $this->faker->url(),  // facebookページ
            'twitter' => $this->faker->url(),  // twitter
            'shop_type' => $this->faker->randomElement(['チェーン店', 'のれん分け', '独自店', '不明']),  // お店のタイプ
            'opening_date' => $this->faker->date('Y/m/d'),  // 開店日
            'menu' => 'ラーメン ' . $this->faker->randomNumber(3) . '円' . "\n" . $this->faker->realText(300),  // メニュー
            'notes' => $this->faker->realText(300),  // 備考
            // 'tags' => '',  // タグ（カラム削除予定）
            'image_path' => '0avVo3lJ28xHMe0XfqYfDJZg4L63BSmlUeRZfk5i.jpg',  // お店イメージ画像
            'other' => $this->faker->realText(300),  // その他（表示なし）
        ];
    }
}
