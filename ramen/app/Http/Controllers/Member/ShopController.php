<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記

class ShopController extends Controller
{
    // フォームデータの配列を定義
    public $forms = 
    [  
        'shop_name',
        'shop_name_kana',
        'branch', 
        'postcode',
        'address1',
        'address2',
        'address3',
        'address4',
        'map_lat',
        'map_long',
        'phone_number1',
        'phone_number2',
        'opening_hour1',
        'opening_hour2',
        'holiday',
        'seats',
        'access',
        'parking',
        'official_site',
        'official_blog',
        'facebook',
        'twitter',
        'shop_type',
        'opening_date',
        'menu',
        'notes',
        'tags',
        'image_name',
    ];
    
    // public $shop_types = ['1' => 'チェーン店', '2' => 'のれん分け', '3' => '独自店', '4' => '不明'];  // 追加
    public $shop_types = ['チェーン店', 'のれん分け', '独自店', '不明'];  // 追加
    public $key = __CLASS__ . '-entry';  //セッションのキーを設定

    public function add(Request $request)
    {
        $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）
        
        // 「修正する」ボタンが押された場合
        if ($request->has('mode')) {
            // セッションを取得する
            $form = $request->session()->get($this->key);

            // セッションが存在する場合（登録後に修正ボタンを押した場合のエラーを回避）
            if (isset($form)) {
                // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
                return view('member.shop.entry', ['shop_types' => $shop_types, 'form' => $form]);
            }
        } 
        // セッションを破棄する
        $form = $request->session()->forget($this->key);

        // フォームデータを初期化
        $form = array_fill_keys($this->forms, '');
        $form['shop_type'] = '不明';

        // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
        return view('member.shop.entry', ['shop_types' => $shop_types, 'form' => $form]);
    }

    public function check(Request $request)
    {
        if (!($request->has('finput'))) {
            $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）

            // フォームデータを初期化
            $form = array_fill_keys($this->forms, '');
            $form['shop_type'] = '不明';

            // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
            return view('member.shop.entry', ['shop_types' => $shop_types, 'form' => $form]);
        }

        // セッションを取得する
        $key = $this->key;
        $form = $request->session()->get($key);

        // セッションが存在する場合
        if (isset($form)) {
            // セッションからimage_name、image_pathを変数に退避
            $ses_image_name = $form['image_name'];
            $ses_image_path = $form['image_path'];
        }

        // セッションを破棄する（image_name、image_pathを変数に退避後）
        $form = $request->session()->forget($key);

        // Varidationを行う
        $this->validate($request, Shops::$rules);

        // フォームを再取得
        $form = $request->except(['image_file']);
        // $image_path = $request->only(['image_path']);
        $image_file = $request['image_file'];

        if (!($request->has('image_name_mode'))) {
            // イメージ画像名を取得
            $image_name = $image_file->getClientOriginalName();
            // $image_data = file_get_contents($image_file->getRealPath());
            // $image_data = mb_convert_encoding($image_data, 'utf-8', 'sjis');
            // イメージ画像を保存
            $path = $request->file('image_file')->store('public/image');
            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');  // Storageファサードでの保存先をS3への変更
            // 保存したイメージ画像パスからファイル名を取得
            $image_path = basename($path);
            // $news->image_path = Storage::disk('s3')->url($path);  // Storageファサードでの保存先をS3への変更

            // フォームのimage_name、image_pathを配列に追加
            $form += array('image_name' => $image_name); 
            $form += array('image_path' => $image_path);

        } else {
            if ($request->image_name_mode !== '1') {
                // イメージ画像が送信されてきた場合
                    if ($request->image_name_mode === '2') {
                        if (isset($image_file)) {
                            // イメージ画像名を取得
                            $image_name = $image_file->getClientOriginalName();
                            // $image_data = file_get_contents($image_file->getRealPath());
                            // $image_data = mb_convert_encoding($image_data, 'utf-8', 'sjis');
                            // イメージ画像を保存
                            $path = $request->file('image_file')->store('public/image');
                            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');  // Storageファサードでの保存先をS3への変更
                            // 保存したイメージ画像パスからファイル名を取得
                            $image_path = basename($path);
                            // $news->image_path = Storage::disk('s3')->url($path);  // Storageファサードでの保存先をS3への変更

                            // フォーム配列のimage_name、image_pathに再取得したフォームデータを設定
                            $form['image_name'] = $image_name; 
                            $form['image_path'] = $image_path;    
                        } else {
                            // フォーム配列のimage_name、image_pathを空にする
                            $form['image_name'] = ''; 
                            $form['image_path'] = '';    
                        }       
                    }
                    if ($request->image_name_mode === '3') {
                        // フォーム配列のimage_name、image_pathに退避したセッションデータを設定
                        $form['image_name'] = $ses_image_name; 
                        $form['image_path'] = $ses_image_path;    
                    }
            } else {
                // フォーム配列のimage_name、image_pathを空にする
                $form['image_name'] = ''; 
                $form['image_path'] = '';    
                // $image_name = '';
                // $image_path = '';
            }
        }

        // $form += array('image_name' => $image_name); 
        // $form += array('image_path' => $image_path);

        // セッションに設定する
        $request->session()->put($key, $form);

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // unset($form['image_path']);
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
        // return redirect('member/shop/check', compact('form'));
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

    // public function fix(Request $request)
    // {
    //     $key = $this->key;

    //     if ($request->mode === 'true') {
    //     if ($request->has('mode')) {
    //         // セッションを取得する
    //         $form = $request->session()->get($key);
    //         // 入力内容をフラッシュデータに保存してmember/shop/entryにリダイレクトする
    //         return redirect('member/shop/entry')->withInput($form);
    //     } else {
    //         // セッションを破棄する
    //         $form = $request->session()->forget($key);
    //     }

    //     // 入力内容をフラッシュデータに保存してmember/shop/entryにリダイレクトする
    //     return redirect('member/shop/entry')->withInput($form);
    // }
    
    public function create(Request $request)
    {
        // セッションを取得する
        $key = $this->key;
        $form = $request->session()->get($key);

        // exit();
        // セッションに値が無い時は登録フォームに戻る
        if (!$form) {
            // member/shop/entryにリダイレクトする
            return redirect('member/shop/entry');
        }

        // Shopsモデルクラスをインスタンス化
        $shop = new Shops;
        // 確認画面経由でフォームデータ取得
        // $form = $request->all();

        // イメージ画像パスがセッションに存在する場合
        // if (isset($form['image_path'])) {
            // $path = $request->file('image_data')->store('public/image');
            // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');  // Storageファサードでの保存先をS3への変更
            // $shop->image_path = basename($path);
            // $shop->image_path = $form['image_path'];
            // $news->image_path = Storage::disk('s3')->url($path);  // Storageファサードでの保存先をS3への変更
        // } else {
        //     $shop->image_path = '';
        // }

        // セッション情報からtokenを削除する
        unset($form['_token']);
        // セッション情報からtokenを削除する
        unset($form['finput']);
        // セッション情報からimage_nameを削除する
        unset($form['image_name']);
        // セッション情報からimage_dataを削除する
        // unset($form['image_data']);

        // フォームからお店イメージ画像が送信されてきたら、$image に画像のパスを格納
        // if (isset($form['image_path'])) {
        //     $path = $request->file('image_path')->store('public/image');
        //     // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');  // Storageファサードでの保存先をS3への変更
        //     $shop->image_path = basename($path);
        //     // $news->image_path = Storage::disk('s3')->url($path);  // Storageファサードでの保存先をS3への変更
        // } else {
        //     $shop->image_path = null;
        // }

        // フォームから送信されてきた_tokenを削除する
        // unset($form['_token']);
        // フォームから送信されてきたimage_pathを削除する
        // unset($form['image_path']);

        // データベース登録用に配列を作成
        $data = array('user_id' => Auth::id(), 'user_id_update' => Auth::id());  // ユーザID、ユーザID（更新者）
        $data += $form;  // フォームデータ
        $data += array('other' => '');  // 備考のデフォルトは空

        // データベースに保存する
        // $shop->fill($form);
        $shop->fill($data);
        $shop->save();

        // セッションを破棄する
        $key = $this->key;
        $form = $request->session()->forget($key);

        // searchにリダイレクトする
        return redirect('search');
    }
}
