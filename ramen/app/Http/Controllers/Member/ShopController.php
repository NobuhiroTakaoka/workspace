<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記

class ShopController extends Controller
{
    public $shop_types = ['チェーン店','のれん分け','独自店','不明'];  // 追加

    public function add(Request $request)
    {
        $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）

        // $lat = $request->lat;
        // $lng = $request->lng;
        // // currentLocationで表示
        // // return view('currentLocation', [
        // return view('member/shop/entry', [

        //     // 現在地緯度latをbladeへ渡す
        //     'lat' => $lat,
        //     // 現在地経度lngをbladeへ渡す
        //     'lng' => $lng,
        // ]);

        // member/shop/entry.blade.php ファイルを渡す
        // return view('member.shop.entry');
        // お店登録ページに渡す戻り値に連想配列$shop_typesを追加
        return view('member.shop.entry', ['shop_types' => $shop_types]);
    }

    public function check(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Shops::$rules);

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        $shop = new Shops;
        // $form = $request->all();

        // データベースに保存する
        // $shop->fill($form);

        // $user_id = $shop->user_id = Auth::id();
        // $map_lat = $shop->map_lat = 0;
        // $map_long = $shop->map_long = 0;
        // $phone_number1 = $shop->phone_number1 = '';
        // $phone_number2 = $shop->phone_number2 = '';
        // $opening_hour1 = $shop->opening_hour1 = '';
        // $opening_hour2 = $shop->opening_hour2 = '';
        // $holiday = $shop->holiday = '';
        // $seats = $shop->seats = '';
        // $access = $shop->access = '';
        // $parking = $shop->parking = '';
        // $official_site = $shop->official_site = '';
        // $official_blog = $shop->official_blog = '';
        // $facebook = $shop->facebook = '';
        // $shop_type = $shop->shop_type = '';
        // $twitter = $shop->twitter = '';
        // $opening_date = $shop->opening_date = '';
        // $menu = $shop->menu = '';
        // $notes = $shop->notes = '';
        // $tags = $shop->tags = '';
        // $other = $shop->other = '';

        // $shop->save();
        
        // member/shop/entryにリダイレクトする
        // return redirect('member/shop/entry/check');
        // お店登録ページに渡す戻り値に連想配列$shop_typesを追加
        return view('member.shop.entry.check', [
            'user_id' => $shop->user_id,
            'shop_name' => $shop->shop_name,
            'shop_name_kana' => $shop->shop_name_kana,
            'branch' => $shop->branch,
            'address1' => $shop->address1,
            'address2' => $shop->address2,
            'address3' => $shop->address3,
            'address4' => $shop->address4,
            'phone_number1' => $shop->phone_number1,
            'phone_number2' => $shop->phone_number2,
            'opening_hour1' => $shop->opening_hour1,
            'opening_hour2' => $shop->opening_hour2,
            'holiday' => $shop->holiday,
            'seats' => $shop->seats,
            'access' => $shop->access,
            'parking' => $shop->parking,
            'official_site' => $shop->official_site,
            'official_blog' => $shop->official_blog,
            'facebook' => $shop->facebook,
            'twitter' => $shop->twitter,
            'shop_type' => $shop->shop_type,
            'opening_date' => $shop->opening_date,
            'menu' => $shop->menu,
            'notes' => $shop->notes,
            'tags' => $shop->tags,
        ]);
    }
}
