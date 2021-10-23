<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記

class ShopController extends Controller
{
    public $shop_types = ['チェーン店','のれん分け','独自店','不明'];  // 追加
    public $key = __CLASS__ . '-entry';  //セッションのキーを設定

    public function add(Request $request)
    {
        // $key = __CLASS__ . '-entry';

        // // if ($request->mode === 'true') {
        // if ($request->has('mode')) {
        //     // セッションを取得する
        //     $form = $request->session()->get($key);
        // } else {
        //     // セッションを破棄する
        //     $form = $request->session()->forget($key);
        // }

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
        // return view('member.shop.entry', ['shop_types' => $shop_types, 'form' => $form]);
    }

    public function check(Request $request)
    {
        // $key = __CLASS__ . '-entry';
        $key = $this->key;

        // セッションを破棄する
        $form = $request->session()->forget($key);

        if (!($request->has("finput"))) {
            $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）
            return view('member.shop.entry', ['shop_types' => $shop_types]);
        }
        // Varidationを行う
        $this->validate($request, Shops::$rules);

        $form = $request->all();

        // セッションに設定する
        // $request->session()->put("form_input", $form);
        // $key = $this->key;
        $request->session()->put($key, $form);

        // $shop = new Shops;
        // $form = $request->all();

        // データベースに保存する
        // $shop->fill($form);

        // $user_id = Auth::id();
        // $shop_name = $request->shop_name;
        // $shop_name_kana = $request->shop_name_kana;
        // $branch = $request->branch;
        // $address1 = $request->address1;
        // $address2 = $request->address2;
        // $address3 = $request->address3;
        // $address4 = $request->address4;
        // $map_lat = $request->map_lat;
        // $map_long = $request->map_long;
        // $phone_number1 = $request->phone_number1;
        // $phone_number2 = $request->phone_number2;
        // $opening_hour1 = $request->opening_hour1;
        // $opening_hour2 = $request->opening_hour2;
        // $holiday = $request->holiday;
        // $seats = $request->seats;
        // $access = $request->access;
        // $parking = $request->parking;
        // $official_site = $request->official_site;
        // $official_blog = $request->official_blog;
        // $facebook = $request->facebook;
        // $shop_type = $request->shop_type;
        // $twitter = $request->twitter;
        // $opening_date = $request->opening_date;
        // $menu = $request->menu;
        // $notes = $request->notes;
        // $tags = $request->tags;
        // $other = $request->other;

        // $shop->save();
        
        // member/shop/entryにリダイレクトする
        // return redirect('member/shop/entry');
        // お店登録確認ページに渡す戻り値に連想配列$shopプロパティを追加
            return view('member.shop.check', compact('form')
            // [
                // 'user_id' => $user_id,
                // 'shop_name' => $shop_name,
                // 'shop_name_kana' => $shop_name_kana,
                // 'branch' => $branch,
                // 'address1' => $address1,
                // 'address2' => $address2,
                // 'address3' => $address3,
                // 'address4' => $address4,
                // 'map_lat' => $map_lat,
                // 'map_long' => $map_long,
                // 'phone_number1' => $phone_number1,
                // 'phone_number2' => $phone_number2,
                // 'opening_hour1' => $opening_hour1,
                // 'opening_hour2' => $opening_hour2,
                // 'holiday' => $holiday,
                // 'seats' => $seats,
                // 'access' => $access,
                // 'parking' => $parking,
                // 'official_site' => $official_site,
                // 'official_blog' => $official_blog,
                // 'facebook' => $facebook,
                // 'twitter' => $twitter,
                // 'shop_type' => $shop_type,
                // 'opening_date' => $opening_date,
                // 'menu' => $menu,
                // 'notes' => $notes,
                // 'tags' => $tags,
                // 'other' => $other,
            // ]
            );
    }

    public function fix(Request $request)
    {
        $key = $this->key;

        // if ($request->mode === 'true') {
        if ($request->has('mode')) {
            // セッションを取得する
            $form = $request->session()->get($key);
        } else {
            // セッションを破棄する
            $form = $request->session()->forget($key);
        }

        // 入力内容をフラッシュデータに保存してmember/shop/entryにリダイレクトする
        return redirect('member/shop/entry')->withInput($form);


        // セッションを取得する
        // $form = $request->session()->get($key);

    }
    
    public function create(Request $request)
    {
        $shop = new Shops;

        // セッションを取得する
        $key = $this->key;
        $form = $request->session()->get($key);

        //セッションに値が無い時は登録フォームに戻る
        if (!$form) {
            // member/shop/entryにリダイレクトする
            return redirect('member/shop/entry');
        }

        // データベースへの登録準備
        $data = array('user_id' => Auth::id());  // ユーザID
        $data += $form;  // セッション情報
        $data += array('other' => '');  // 備考のデフォルトは空

        // $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);


        // データベースに保存する
        // $shop->fill($form);
        $shop->fill($data);
        $shop->save();

        // セッションを破棄する
        $form = $request->session()->forget($key);

        // searchにリダイレクトする
        return redirect('search');
    }
}
