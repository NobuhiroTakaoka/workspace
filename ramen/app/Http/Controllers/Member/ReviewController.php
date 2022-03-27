<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // レビュー投稿フォームデータの配列を定義
    public $forms = 
    [  
        'menu_title',
        'category',
        'soup', 
        'points', 
        'image_name',
        'image_path',
        'comment',
    ];

    public $key = __CLASS__ . '-rev_post';  //レビュー登録セッションのキーを設定

    public function reviewPost(Request $request, int $shop_id)
    {
        // shop_nameを変数に設定
        $shop_name = $request->shop_name;

        // shop_nameを変数に設定
        $branch = $request->branch;

        // 「修正する」ボタンが押された場合
        if ($request->has('mode')) {
            // セッションを取得する
            $form = $request->session()->get($this->key);

            // セッションが存在する場合（登録後に修正ボタンを押した場合のエラーを回避）
            if (isset($form)) {
                // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
                return view('member.shop.review_post', ['form' => $form, 'shop_id' => $shop_id, 'shop_name' => $shop_name, 'branch' => $branch]);
            }
        } 
        // セッションを破棄する
        $form = $request->session()->forget($this->key);

        // フォームデータを初期化
        $form = array_fill_keys($this->forms, '');
        $form += array('shop_name' => $shop_name, 'branch' => $branch);

        // レビュー投稿ページに渡す
        return view('member.shop.review_post', ['form' => $form, 'shop_id' => $shop_id, 'shop_name' => $shop_name, 'branch' => $branch]);
    }

    public function reviewCheck(Request $request)
    {
        // $request->shop_idが存在する場合
        if (isset($request->shop_id)) {
            $shop_id = $request->shop_id;
        }

        // $request->image_pathが存在する場合
        if (isset($request->image_path)) {
            $image_path = $request->image_path;
        }

        if (!$request->has('finput') && !$request->has('fedit')) {
            // レビュー投稿フォームデータを初期化
            $form = array_fill_keys($this->forms, '');

            // レビュー投稿ページに渡す戻り値に連想配列$formを追加
            return view('member.shop.review_post', ['form' => $form]);
        }

        // セッションを取得する（更新の場合、登録の場合）
        $key = $this->key;
        $form = $request->session()->get($key);

        // セッションが存在する場合
        if (isset($form)) {
            // セッションからimage_name、image_pathを変数に退避
            $ses_image_name = $form['image_name'];
            $ses_image_path = $form['image_path'];
        } else {
            // 初回確認画面の場合
            if (isset($image_path)) {
                $ses_image_path = $image_path;
            } else {
                $ses_image_path = '';
            }
            $ses_image_name = '';
        }

        // セッションを破棄する（image_name、image_pathを変数に退避後）
        $form = $request->session()->forget($key);

        // フォームを再取得
        $form = $request->except(['menu_image']);

        // Varidationを行う
        $this->validate($request, Reviews::$rules);

        // $image_path = $request->only(['image_path']);
        $menu_image = $request['menu_image'];

        // 選択済みの画像ファイルが存在しない場合
        if (!$request->has('image_name_mode')) {
            if (isset($menu_image)) {
                // 画像ファイル名を取得
                $image_name = $menu_image->getClientOriginalName();
                // 画像ファイルを保存
                $path = $request->file('menu_image')->store('public/image');
                // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');  // Storageファサードでの保存先をS3への変更
                // 保存した画像ファイルパスからファイル名を取得
                $image_path = basename($path);
                // $news->image_path = Storage::disk('s3')->url($path);  // Storageファサードでの保存先をS3への変更

                // フォームのimage_name、image_pathの配列を上書き
                $form['image_name'] = $image_name; 
                $form['image_path'] = $image_path;
            } else {
                // フォーム配列のimage_name、image_pathを空にする
                $form['image_name'] = ''; 
                $form['image_path'] = '';    
            }

        } else {
            // 画像ファイル削除が送信されてきた場合
            if ($request->image_name_mode === '1') {
                // フォーム配列のimage_name、image_pathを空にする
                $form['image_name'] = ''; 
                $form['image_path'] = '';    
            }
            // 画像ファイル変更が送信されてきた場合
            if ($request->image_name_mode === '2') {
                if (isset($menu_image)) {
                    // イメージ画像名を取得
                    $image_name = $menu_image->getClientOriginalName();
                    // イメージ画像を保存
                    $path = $request->file('menu_image')->store('public/image');
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
            // 画像ファイル変更なしが送信されてきた場合
            if ($request->image_name_mode === '3') {
                // フォーム配列のimage_name、image_pathに退避したセッションデータを設定
                $form['image_name'] = $ses_image_name; 
                $form['image_path'] = $ses_image_path;    
            }
        }

        // セッションに設定する
        $request->session()->put($key, $form);

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // unset($form['image_path']);

        if ($request->has('image_name_mode')) {
            $chk_img_mode = $request->image_name_mode;
        } else {
            $chk_img_mode = '';
        }

        // レビュー投稿確認ページに渡す戻り値に連想配列$shopプロパティを追加
        return view('member.shop.review_check', ['form' => $form, 'shop_id' => $shop_id, 'chk_img_mode' => $chk_img_mode]);
    }

    public function reviewCreate(Request $request)
    {
        // セッションを取得する
        $key = $this->key;
        $form = $request->session()->get($key);

        // $request->shop_idを取得する
        $shop_id = $request->shop_id;

        // セッションに値が無い時は登録フォームに戻る
        if (!$form) {
            // searchにリダイレクトする
            return redirect('shop/detail/' . $shop_id . '/review/post');
        }

        // Reviewsモデルクラスをインスタンス化
        $shop = new Reviews;

        // セッション情報からtokenを削除する
        unset($form['_token']);
        // セッション情報からfinputを削除する
        unset($form['finput']);
        // セッション情報からimage_nameを削除する
        unset($form['image_name']);

        // 登録データを初期化
        $data = array_fill_keys($this->forms, '');
        // $data['shop_type'] = '不明';

        // データベース登録用に配列を作成
        $data = array('shop_id' => $shop_id, 'user_id' => Auth::id());  // 店舗ID、ユーザID
        $data += $form;  // フォームデータ

        // データベースに保存する
        $shop->fill($data);
        $shop->save();

        // セッションを破棄する
        $key = $this->key;
        $form = $request->session()->forget($key);

        // searchにリダイレクトする
        return redirect('search');
    }
}
