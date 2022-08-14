<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use App\Commons\MasterCommons;
use App\Models\Reviews;
use App\Models\Prefectures;  // 追記
// use Illuminate\Support\Facades\Auth;  // 追記

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
        // $this->user_id = Auth::id();
    }

    public function index(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        // $disp = $request->disp ?? 10;
        
        // $reviews = Reviews::orderByDesc('updated_at')->paginate($disp);
        $reviews = Reviews::select('reviews.*', 'shops.shop_name', 'shops.branch', 'users.name')
            ->join('shops', 'reviews.shop_id', '=', 'shops.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->whereNull('reviews.deleted_at')
            ->orderByDesc('reviews.created_at')
            ->limit(10)
            ->get();
            // ->paginate($disp);

        // ログイン中のユーザIDを取得
        // $user_id = Auth::id();

        // info/index.blade.php ファイルを渡す
        return view('info.index', ['reviews' => $reviews]);
        // return view('info.index', ['reviews' => $reviews, 'disp' => $disp]);
    }

    public function search(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;
        // 検索キーワードを変数に設定
        $keyword = $request->keyword;
        // 都道府県IDを変数に設定
        $pref_id = $request->preflist;
        // 市区町村を変数に設定
        $city = $request->city;

        // Prefecturesモデルクラスをインスタンス化
        $pref = new Prefectures();

        // Prefecturesテーブルの都道府県名を全取得
        $pref_names = $pref::select('prefectures.pref_name');

        if (!empty($pref_id)) {
            // $pref_idから$pref_nameを取得
            $pref_rec = $pref::select()->find($pref_id);
            $pref_name = $pref_rec->pref_name;
        } else {
            $pref_name = '';
        }

        // 検索条件に含まれているタグを変数に設定。検索条件にタグが含まれていない場合は初期化
        $tags = is_array($request->tags) ? $request->tags : [];

        $tags_flag = is_array($tags) && count($tags) > 0;

        // 検索条件に含まれているタイプのキーを変数に設定。検索条件にタイプが含まれていない場合は初期化
        $types = is_array($request->types) ? $request->types : [];

        // 検索条件に含まれているタイプの場合はバリューを配列$types_itemに格納
        if ($types) {
            foreach ($types as $key => $type) {
                foreach ($this->shop_types as $key => $shop_type) {
                    if ($key == (Integer)$type) {
                        $types_item[] = $shop_type;
                    }
                }
            }
        } else {
            $types_item = [];
        }

        $types_flag = is_array($types_item) && count($types_item) > 0;

        $shops = Shops::select('shops.*', Reviews::raw('avg(reviews.points) as avg_points', 'count(*) as count'))
        // ->leftjoin('reviews', 'shops.id', '=', 'reviews.shop_id')
        ->leftjoin('reviews', function($join) {
            $join->on('shops.id', '=', 'reviews.shop_id')
            ->whereNull('reviews.deleted_at');
        })
        ->when($tags_flag, function($query) use ($tags) {
            return $query->whereHas('tags', function($query2) use ($tags) {
                return $query2->whereIn('tag_id', $tags);
            });
        })
        ->when($keyword != '', function($query3) use ($keyword) {
            return $query3->where(function($query4) use ($keyword) {
                return $query4->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
                            ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
                            ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
                            ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%')
                            ->orWhere('address4', 'like', '%' .  addslashes($keyword) . '%');
            });
        })
        ->when($pref_name != '', function($query5) use ($pref_name, $pref_names) {
            return $query5->when($pref_name != '海外', function($query6) use ($pref_name) {
                return $query6->where('address1', addslashes($pref_name));
            }, function($query7) use ($pref_names) {
                return $query7->whereNotIn('address1', $pref_names);
            });
        })
        ->when($city != '', function($query8) use ($city) {
            return $query8->where('address2', addslashes($city));
        })
        ->when($types_flag, function($query9) use ($types_item) {
            return $query9->whereIn('shop_type', $types_item);
        })
        ->groupby('shops.id')
        ->paginate($disp);

        $params = [
            'tags' => is_array($request->tags) ? $request->tags : [],
            'types' => is_array($request->types) ? $request->types : [],
        ];

        // ログイン中のユーザIDを取得
        // $user_id = Auth::id();

        return view('info.search', [
            'shops' => $shops,
            'keyword' => $keyword,
            'pref_id' => $pref_id,
            'pref_name' => $pref_name,
            'city' => $city,
            'disp' => $disp, 
            'shop_types' => $this->shop_types,
            'tags_category' => $this->tags_category,
            'params' => $params,
        ]);        
    }

    public function ranking(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;
        // 都道府県IDを変数に設定
        $pref_id = $request->preflist;
        // 市区町村を変数に設定
        $city = $request->city;

        // Prefecturesモデルクラスをインスタンス化
        $pref = new Prefectures();

        if (!empty($pref_id)) {
            // $prefectureのshopsテーブルのレコードを取得
            $pref_rec = $pref::select()->find($pref_id);
            $pref_name = $pref_rec->pref_name;
        } else {
            $pref_name = '';
        }

        // 検索条件に含まれているタイプのキーを変数に設定。検索条件にタイプが含まれていない場合は初期化
        $types = is_array($request->types) ? $request->types : [];

        // 検索条件に含まれているタイプの場合はバリューを配列$types_itemに格納
        if ($types) {
            foreach ($types as $key => $type) {
                foreach ($this->shop_types as $key => $shop_type) {
                    if ($key == (Integer)$type) {
                        $types_item[] = $shop_type;
                    }
                }
            }
        } else {
            $types_item = [];
        }

        $types_flag = is_array($types_item) && count($types_item) > 0;

        $shops = Shops::select('shops.*', Reviews::raw('avg(reviews.points) as avg_points'))
        // ->leftjoin('reviews', 'shops.id', '=', 'reviews.shop_id')
        ->leftjoin('reviews', function($join) {
            $join->on('shops.id', '=', 'reviews.shop_id')
            ->whereNull('reviews.deleted_at');
        })
        ->when($pref_name != '', function($query5) use ($pref_name) {
            return $query5->where('address1', addslashes($pref_name));
        })
        ->when($city != '', function($query6) use ($city) {
            return $query6->where('address2', addslashes($city));
        })
        ->when($types_flag, function($query7) use ($types_item) {
            return $query7->whereIn('shop_type', $types_item);
        })
        ->groupby('shops.id')
        ->orderByDesc('avg_points')
        ->limit(100)
        ->paginate($disp);

        $params = [
            'types' => is_array($request->types) ? $request->types : [],
        ];

        //表示するページの先頭の順位のカウンターを設定
        $counter = $shops->firstItem();
        
        // info/ranking.blade.php ファイルを渡す
        return view('info.ranking', [
            'shops' => $shops,
            'pref_id' => $pref_id,
            'pref_name' => $pref_name,
            'city' => $city,
            'disp' => $disp,
            'shop_types' => $this->shop_types,
            'params' => $params,
            'types_item' => $types_item,
            'counter' => $counter,
        ]);
    }

    public function searchPref(Request $request)
    {
        $url = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=".$request->prefecture_id;
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $arr = json_decode($json,true);
        return $arr;
    }
}
