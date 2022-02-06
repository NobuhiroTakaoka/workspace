<?php

namespace App\Http\Controllers;

use App\Models\Shops;  // 追加
use App\Models\ShopTags;  // 追加
use Illuminate\Http\Request;
use App\Commons\MasterCommons;
use App\Models\Reviews;

class ShopController extends Controller
{
    // リストを初期化
    private $shop_types = [];  // お店のタイプリスト
    private $tags_category = [];  // タグリスト

    // コンストラクタでMasterCommonsクラスより、リストの配列を定義
    public function __construct()
    {
        $this->shop_types = MasterCommons::$shop_types;
        $this->tags_category = MasterCommons::$tags_category;
    }

    public function refer(Request $request, int $shop_id)
    {
        // Shopsモデルクラスをインスタンス化
        $shop = new Shops();

        // $shop_idのshopsテーブルのレコードを取得
        $shop_detail = $shop::select()->find($shop_id);

        // $shop_idのshop_tagsテーブルのレコードを取得
        $shop_tags = ShopTags::where('shop_id', $shop_id)->get();

        // shop/detail.blade.php ファイルを渡す
        return view('shop.detail', ['shop_detail' => $shop_detail, 'shop_tags' => $shop_tags, 'tags_category' => $this->tags_category, 'shop_id' => $shop_id]);
    }

    public function reviewRefer(Request $request, int $shop_id)
    {
        // Reviewsモデルクラスをインスタンス化
        $shop = new Reviews();

        // $shop_idのshopsテーブルのレコードを取得
        $shop_detail = $shop::select()->find($shop_id);

        // $shop_idのshop_tagsテーブルのレコードを取得
        $shop_tags = ShopTags::where('shop_id', $shop_id)->get();

        // shop/detail.blade.php ファイルを渡す
        return view('shop.detail', ['shop_detail' => $shop_detail, 'shop_tags' => $shop_tags, 'tags_category' => $this->tags_category, 'shop_id' => $shop_id]);
    }
}
