<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use App\Models\ShopTags;  // 追記
use Carbon\Carbon;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記
use App\Commons\MasterCommons;  // 追記

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
        'image_path',
    ];
    
    // リストを初期化
    private $shop_types = [];  // お店のタイプリスト
    private $tags_category = [];  // タグリスト

    // コンストラクタでMasterCommonsクラスより、リストの配列を定義
    public function __construct()
    {
        $this->shop_types = MasterCommons::$shop_types;
        $this->tags_category = MasterCommons::$tags_category;
    }

    public $key = __CLASS__ . '-entry';  //登録セッションのキーを設定
    public $key2 = __CLASS__ . '-edit';  //更新セッションのキーを設定

    public function add(Request $request)
    {
        $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）
        $tags_category = $this->tags_category;  // 追加（メソッド外の連想配列$tags_categoryをこのメソッド変数に格納）
        
        // 「修正する」ボタンが押された場合
        if ($request->has('mode')) {
            // セッションを取得する
            $form = $request->session()->get($this->key);

            // セッションが存在する場合（登録後に修正ボタンを押した場合のエラーを回避）
            if (isset($form)) {
                // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
                return view('member.shop.entry', ['shop_types' => $shop_types, 'tags_category' => $tags_category, 'form' => $form]);
            }
        } 
        // セッションを破棄する
        $form = $request->session()->forget($this->key);

        // フォームデータを初期化
        $form = array_fill_keys($this->forms, '');
        $form['shop_type'] = '不明';
        // $form['tags'] = [];

        // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
        return view('member.shop.entry', ['shop_types' => $shop_types, 'tags_category' => $tags_category, 'form' => $form]);
    }

    public function check(Request $request)
    {
        // $request->shop_idが存在する場合
        if (isset($request->shop_id)) {
            $shop_id = $request->shop_id;
        }

        // $request->image_pathが存在する場合
        if (isset($request->image_path)) {
            $image_path = $request->image_path;
        }

        $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）
        $tags_category = $this->tags_category;  // 追加（メソッド外の連想配列$tags_categoryをこのメソッド変数に格納）

        if (!$request->has('finput') && !$request->has('fedit')) {
            // フォームデータを初期化
            $form = array_fill_keys($this->forms, '');
            $form['shop_type'] = '不明';

            // お店登録ページに渡す戻り値に連想配列$shop_types、$formを追加
            return view('member.shop.entry', ['shop_types' => $shop_types, 'tags_category' => $tags_category, 'form' => $form]);
        }

        // 登録の場合は$shop_idを初期化
        if ($request->has('finput')) {
            $shop_id = 0;
        }

        // セッションを取得する（更新の場合、登録の場合）
        if ($request->has('fedit')) {
            $key2 = $this->key2;
            $form = $request->session()->get($key2);
        } else {
            $key = $this->key;
            $form = $request->session()->get($key);
        }

        // セッションが存在する場合
        if (isset($form)) {
            // セッションからimage_name、image_pathを変数に退避
            $ses_image_name = $form['image_name'];
            $ses_image_path = $form['image_path'];
        } else {
            // 更新の初回確認画面の場合
            if (isset($image_path)) {
                $ses_image_path = $image_path;
            } else {
                $ses_image_path = '';
            }
            $ses_image_name = '';
        }

        // セッションを破棄する（image_name、image_pathを変数に退避後）（更新の場合、登録の場合）
        if ($request->has('fedit')) {
            $form = $request->session()->forget($key2);
        } else {
            $form = $request->session()->forget($key);
        }

        // フォームデータを初期化
        // $form = array_fill_keys($this->forms, '');
        // $form['shop_type'] = '不明';

        // フォームを再取得
        $form = $request->except(['image_file']);

        // Varidationを行う
        $this->validate($request, Shops::$rules);

        // $image_path = $request->only(['image_path']);
        $image_file = $request['image_file'];

        // 選択済みの画像ファイルが存在しない場合
        if (!$request->has('image_name_mode')) {
            if (isset($image_file)) {
                // 画像ファイル名を取得
                $image_name = $image_file->getClientOriginalName();
                // 画像ファイルを保存
                $path = $request->file('image_file')->store('public/image');
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
                if (isset($image_file)) {
                    // イメージ画像名を取得
                    $image_name = $image_file->getClientOriginalName();
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
            // 画像ファイル変更なしが送信されてきた場合
            if ($request->image_name_mode === '3') {
                // フォーム配列のimage_name、image_pathに退避したセッションデータを設定
                $form['image_name'] = $ses_image_name; 
                $form['image_path'] = $ses_image_path;    
            }
        }

        // セッションに設定する（更新の場合、登録の場合）
        if ($request->has('fedit')) {
            $request->session()->put($key2, $form);
        } else {
            $request->session()->put($key, $form);
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // unset($form['image_path']);

        if ($request->has('image_name_mode')) {
            $chk_img_mode = $request->image_name_mode;
        } else {
            $chk_img_mode = '';
        }

        // 更新・登録のチェックモードを設定
        if ($request->has('fedit')) {
            $chk_mode = 'edit';
        } else {
            $chk_mode = 'input';
        }

        // お店登録確認ページに渡す戻り値に連想配列$shopプロパティを追加
        // return view('member.shop.check', compact('form', 'tags_category'));
        return view('member.shop.check', ['form' => $form, 'tags_category' => $tags_category, 'chk_mode' => $chk_mode, 'shop_id' => $shop_id, 'chk_img_mode' => $chk_img_mode]);
    }
    
    public function create(Request $request)
    {
        // セッションを取得する
        $key = $this->key;
        $form = $request->session()->get($key);

        // セッションに値が無い時は登録フォームに戻る
        if (!$form) {
            // member/shop/entryにリダイレクトする
            return redirect('member/shop/entry');
        }

        // Shopsモデルクラスをインスタンス化
        $shop = new Shops;

        // セッション情報からtokenを削除する
        unset($form['_token']);
        // セッション情報からtokenを削除する
        unset($form['finput']);
        // セッション情報からimage_nameを削除する
        unset($form['image_name']);

        // 登録データを初期化
        $data = array_fill_keys($this->forms, '');
        $data['shop_type'] = '不明';

        // データベース登録用に配列を作成
        $data = array('user_id' => Auth::id(), 'user_id_update' => Auth::id());  // ユーザID、ユーザID（更新者）
        $data += $form;  // フォームデータ

        // 任意入力の項目がnullの場合は空文字を設定
        if (!isset($data['branch'])) {
            $data['branch'] = '';
        }

        if (!isset($data['phone_number2'])) {
            $data['phone_number2'] = '';
        }

        if (!isset($data['opening_hour2'])) {
            $data['opening_hour2'] = '';
        }

        if (!isset($data['official_site'])) {
            $data['official_site'] = '';
        }

        if (!isset($data['official_blog'])) {
            $data['official_blog'] = '';
        }

        if (!isset($data['facebook'])) {
            $data['facebook'] = '';
        }

        if (!isset($data['twitter'])) {
            $data['twitter'] = '';
        }

        if (!isset($data['opening_date'])) {
            $data['opening_date'] = '';
        }

        if (!isset($data['notes'])) {
            $data['notes'] = '';
        }

        $data['tags'] = '';  // shopsテーブルのタグは未使用のため空

        $data['other'] = '';  // 備考のデフォルトは空

        // データベースに保存する
        $shop->fill($data);
        $shop->save();

        // $form['tags']が配列の場合（タグが選択されている場合は配列でリクエストを受け取っているため）
        if (is_array($form['tags'])) {
            // タグID格納配列（$inserts）にtag_id分のレコードをshop_idと併せて一括登録用配列（$inserts）に格納する
            $inserts = [];
            foreach ($form['tags'] as $tag) {
                $inserts[] = [
                    'shop_id' => $shop->id,
                    'tag_id' => (Integer)$tag,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            // $insertsに値が格納されている場合
            if (count($inserts) > 0) {
                $shop_tag = new ShopTags;
                $shop_tag->insert($inserts);
            }
        }

        // セッションを破棄する
        $key = $this->key;
        $form = $request->session()->forget($key);

        // searchにリダイレクトする
        return redirect('search');
    }

    public function edit(Request $request, int $shop_id)
    {
        $shop_types = $this->shop_types;  // 追加（メソッド外の連想配列$shop_typesをこのメソッド変数に格納）
        $tags_category = $this->tags_category;  // 追加（メソッド外の連想配列$tags_categoryをこのメソッド変数に格納）

        // Shopsモデルクラスをインスタンス化
        $shop = new Shops();

        // $shop_idのshopsテーブルのレコードを取得
        $shop_detail = $shop::select()->find($shop_id);

        // $shop_idのshop_tagsテーブルのレコードを取得
        $shop_tags = ShopTags::where('shop_id', $shop_id)->get();

        // 「修正する」ボタンが押された場合
        if ($request->has('reedit')) {

            // フォームデータを初期化
            $form = array_fill_keys($this->forms, '');
            $form['shop_type'] = '不明';

            // セッションを取得する
            $form = $request->session()->get($this->key2);

            // $shop_idのshop_tagsテーブルのレコードからimage_pathを$form配列に追加
            // $form += ['image_path' => $shop_detail->image_path];

            // セッションが存在する場合（更新後に修正するボタンを押した場合のエラーを回避）
            if (isset($form)) {
                // 任意入力の項目がnullの場合は空文字を設定
                if (!isset($form['branch'])) {
                    $form['branch'] = '';
                }

                if (!isset($form['phone_number2'])) {
                    $form['phone_number2'] = '';
                }

                if (!isset($form['opening_hour2'])) {
                    $form['opening_hour2'] = '';
                }

                if (!isset($form['official_site'])) {
                    $form['official_site'] = '';
                }

                if (!isset($form['official_blog'])) {
                    $form['official_blog'] = '';
                }

                if (!isset($form['facebook'])) {
                    $form['facebook'] = '';
                }

                if (!isset($form['twitter'])) {
                    $form['twitter'] = '';
                }

                if (!isset($form['opening_date'])) {
                    $form['opening_date'] = '';
                }

                if (!isset($form['notes'])) {
                    $form['notes'] = '';
                }

                $form['tags'] = '';  // shopsテーブルのタグは未使用

                if (!isset($form['image_path'])) {
                    $form['image_path'] = '';
                }

                if (!isset($form['other'])) {
                    $form['other'] = '';
                }
                
                return view('member.shop.edit', ['shop_tags' => $shop_tags, 'shop_types' => $shop_types, 'tags_category' => $tags_category, 'form' => $form, 'shop_id' => $shop_id]);
            }
        } 
        // セッションを破棄する
        $form = $request->session()->forget($this->key2);

        // shop/detail.blade.php ファイルを渡す
        return view('member.shop.edit', ['shop_detail' => $shop_detail, 'shop_tags' => $shop_tags, 'shop_types' => $shop_types, 'tags_category' => $tags_category, 'form' => $form, 'shop_id' => $shop_id]);
    }
}
