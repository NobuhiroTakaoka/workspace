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

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Shops::$rules);

        $shop = new Shops;
        $form = $request->all();

        // データベースに保存する
        $shop->fill($form);
        $shop->user_id = Auth::id();
        $shop->map_lat = 0;
        $shop->map_long = 0;
        $shop->phone_number1 = '';
        $shop->phone_number2 = '';
        $shop->opening_hour1 = '';
        $shop->opening_hour2 = '';
        $shop->holiday = '';
        $shop->seats = '';
        $shop->access = '';
        $shop->parking = '';
        $shop->official_site = '';
        $shop->official_blog = '';
        $shop->facebook = '';
        $shop->shop_type = '';
        $shop->twitter = '';
        $shop->opening_date = '';
        $shop->menu = '';
        $shop->notes = '';
        $shop->tags = '';
        $shop->other = '';

        $shop->save();
        
        // member/shop/entryにリダイレクトする
        return redirect('member/shop/entry');
    }
}
