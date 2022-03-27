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

    public function reviewList(Request $request, int $shop_id)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;

        // shop_nameを変数に設定
        $shop_name = $request->shop_name;

        // shop_nameを変数に設定
        $branch = $request->branch;

        // Reviewsモデルクラスをインスタンス化
        $review = new Reviews();

        // $shop_idのreviewsテーブルのレコードを取得
        $review_list = $review::select('reviews.*', 'users.name')->where('shop_id', $shop_id)
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->orderByDesc('reviews.updated_at')
            ->paginate($disp);

        // shop/review.blade.php ファイルを渡す
        return view('shop.review_list', ['review_list' => $review_list, 'shop_id' => $shop_id, 'disp' => $disp, 'shop_name' => $shop_name, 'branch' => $branch]);
    }

    public function reviewRefer(Request $request, int $shop_id, int $review_id)
    {
        // Reviewsモデルクラスをインスタンス化
        $review = new Reviews();

        // $shop_idのreviewsテーブルのレコードを取得
        $review_detail = Reviews::select('reviews.*', 'shops.shop_name', 'shops.branch', 'users.name')->where('reviews.id', $review_id)
            ->join('shops', 'reviews.shop_id', '=', 'shops.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->orderByDesc('reviews.updated_at')
            ->get();

        // shop/review.blade.php ファイルを渡す
        return view('shop.review_detail', ['review_detail' => $review_detail, 'shop_id' => $shop_id]);
    }
}
