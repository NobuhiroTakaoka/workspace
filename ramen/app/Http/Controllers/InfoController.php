<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use App\Commons\MasterCommons;

class InfoController extends Controller
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

    public function index(Request $request)
    {
        // info/index.blade.php ファイルを渡す
        return view('info.index');
    }

    public function search(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;
        // 検索キーワードを変数に設定
        $keyword = $request->keyword;
        // $form['keyword'] = $request->keyword;
        // 検索条件に含まれているタグを変数に設定。検索条件にタグが含まれていない場合は初期化
        $tags = is_array($request->tags) ? $request->tags : [];

        if ($keyword != '') {
            // タグが検索条件になっている場合
            if (!empty($tags)) {
                $shops = Shops::where(function($query) use ($keyword) {
                    $query->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%');
                })->whereHas('tags', function($query) use ($tags) {
                    $query->whereIn('tag_id', $tags);
                })
                ->paginate($disp);
            } else {
                // 検索されたら検索結果を取得する →あいまい検索+SQLインジェクション対策の実装を追加
                // $shops = Shops::where('shop_name', 'like', '%' .  addslashes($keyword) . '%')->paginate($disp);
                $shops = Shops::where(function($query) use ($keyword) {
                    $query->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
                          ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%');
                })->paginate($disp);
            }
        } else {
            // それ以外はすべてのお店を取得する
            $tags = is_array($request->tags) ? $request->tags : [];
            // $tags = $request->tags;
            // $shops = Shops::when(is_array($tags), function($query) use ($tags) {

            //     return $query->whereIn('id')
            // })->paginate($disp);

            // $shops = ShopTags::when(is_array($tags), function($query) use ($tags) {
            //     return $query->whereIn('tag_id', $tags);
            // })->get();
            
            if (!empty($tags)) {
                $shops = Shops::whereHas('tags', function($query) use ($tags) {
                    $query->whereIn('tag_id', $tags);
                })
                ->paginate($disp);
            } else {
                $shops = Shops::paginate($disp);
            }
            
            // $shops = Shops::paginate($disp);
        }

        $params = [
            'tags' => is_array($request->tags) ? $request->tags : [],
        ];

        // $shops->get();

        // info/search.blade.php ファイルを渡す
        // return view('info.search', ['shops' => $shops, 'keyword' => $keyword, 'disp' => $disp, 'form' => $form]);
        return view('info.search', [
            'shops' => $shops,
            'keyword' => $keyword,
            'disp' => $disp, 
            'shop_types' => $this->shop_types,
            'tags_category' => $this->tags_category,
            'params' => $params,
        ]);        
    }

    public function ranking(Request $request)
    {
        // info/ranking.blade.php ファイルを渡す
        return view('info.ranking');
    }
}
