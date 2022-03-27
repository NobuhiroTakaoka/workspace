<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;  // 追記 
use App\Models\Prefectures;  // 追記
use App\Models\Cities;  // 追記

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Client $client, Prefectures $prefectures, Cities $cities)
    {
        // 都道府県取得
        $prefs = $prefectures->all();

        foreach ($prefs->pluck('id') as $prefecture_id) {
            // 外部API全国地方公共団体コード
            $api = 'https://www.land.mlit.go.jp/webland/api/CitySearch?area=' .str_pad($prefecture_id, 2, 0, STR_PAD_LEFT);
            $respone_datas = $client->request('GET', $api);
            $respone_bodys = json_decode($respone_datas->getBody()->getContents(), true);
       
            // APIのステータスがOKなら実行
            if ($respone_bodys['status'] === 'OK') {
                foreach ($respone_bodys['data'] as $respone_body) {
                    // 都道府県の外部キーを指定して市区町村を登録
                    $cities->create([
                        'prefecture_id' => $prefecture_id,
                        'city_code'     => $respone_body['id'],
                        'city_name'     => $respone_body['name'],
                    ]);
                }
            }
        }
    }
}
