<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;  // 追記
use App\Commons\MasterCommons;
use App\Models\Reviews;
use App\Models\Prefectures;  // 追記
// use Illuminate\Support\Facades\DB;  // 追記

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
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;
        
        // $reviews = Reviews::orderByDesc('updated_at')->paginate($disp);
        $reviews = Reviews::select('reviews.*', 'shops.shop_name', 'shops.branch', 'users.name')
            ->join('shops', 'reviews.shop_id', '=', 'shops.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->orderByDesc('reviews.updated_at')
            ->paginate($disp);

        // info/index.blade.php ファイルを渡す
        return view('info.index', ['reviews' => $reviews, 'disp' => $disp]);
    }

    public function search(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;
        // 検索キーワードを変数に設定
        $keyword = $request->keyword;
        // $form['keyword'] = $request->keyword;
        // 都道府県IDを変数に設定
        $pref_id = $request->preflist;
        // 市区町村を変数に設定
        $city = $request->city;

        // if (empty($city)) {
        //     $city = '';
        // }

        // Prefecturesモデルクラスをインスタンス化
        $pref = new Prefectures();

        if (!empty($pref_id)) {
            // $prefectureのshopsテーブルのレコードを取得
            $pref_rec = $pref::select()->find($pref_id);
            $pref_name = $pref_rec->pref_name;
        } else {
            $pref_name = '';
        }

        // 検索条件に含まれているタグを変数に設定。検索条件にタグが含まれていない場合は初期化
        $tags = is_array($request->tags) ? $request->tags : [];

        $tags_flag = is_array($tags) && count($tags) > 0;

        // if ($keyword != '') {
            // \DB::enableQueryLog();
            $shops = Shops::select()
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
            ->when($pref_name != '', function($query5) use ($pref_name) {
                return $query5->where('address1', addslashes($pref_name));
            })
            ->when($city != '', function($query6) use ($city) {
                return $query6->where('address2', addslashes($city));
            })


            //     return $query->where('address1', addslashes($pref_name))
            //         ->where('address2', addslashes($city))
            //         ->where(function($query3) use ($keyword) {
            //         return $query3->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
            //                 ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
            //                 ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
            //                 ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%')
            //                 ->orWhere('address4', 'like', '%' .  addslashes($keyword) . '%');
            //     });
            // })
            // ->when($keyword == '', function($query) use ($pref_name, $city) {
            //     return $query->where('address1', addslashes($pref_name))
            //         ->where('address2', addslashes($city));
            // })
            // ->tosql();
            ->paginate($disp);
            // DD($shops);
            // dd(\DB::getQueryLog());

            // // タグが検索条件になっている場合
            // if (!empty($tags)) {
            //     $shops = Shops::where(function($query) use ($keyword) {
            //         $query->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%');
            //     })->whereHas('tags', function($query) use ($tags) {
            //         $query->whereIn('tag_id', $tags);
            //     })->where('address1', 'like', addslashes($pref_name))
            //       ->where('address2', 'like', addslashes($city))
            //     ->paginate($disp);
            // } else {
            //     // 検索されたら検索結果を取得する →あいまい検索+SQLインジェクション対策の実装を追加
            //     // $shops = Shops::where('shop_name', 'like', '%' .  addslashes($keyword) . '%')->paginate($disp);
            //     $shops = Shops::where(function($query) use ($keyword) {
            //         $query->orWhere('shop_name', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('shop_name_kana', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('branch', 'like', '%' .  addslashes($keyword) . '%')
            //               ->orWhere('address3', 'like', '%' .  addslashes($keyword) . '%');
            //     })->where('address1', 'like', addslashes($pref_name))
            //       ->where('address2', 'like', addslashes($city))
            //     ->paginate($disp);
            // }
        // } else {
            // それ以外はすべてのお店を取得する
            // $tags = is_array($request->tags) ? $request->tags : [];
            // $tags = $request->tags;
            // $shops = Shops::when(is_array($tags), function($query) use ($tags) {

            //     return $query->whereIn('id')
            // })->paginate($disp);

            // $shops = Shops::when($tags_flag, function($query) use ($tags) {
            //     return $query->whereHas('tags', function($query2) use ($tags) {
            //         return $query2->whereIn('tag_id', $tags);
            //     });
            // })
            // ->where('address1', 'like', addslashes($pref_name))
            // ->where('address2', 'like', addslashes($city))   
            // ->paginate($disp);
            
            // if (!empty($tags)) {
            //     $shops = Shops::whereHas('tags', function($query) use ($tags, $pref_name, $city) {
            //         $query->whereIn('tag_id', $tags);
            //         $query->where('address1', 'like', addslashes($pref_name));
            //         $query->where('address2', 'like', addslashes($city));

            //     })
            //     ->paginate($disp);
            // } else {
            //     $shops = Shops::where(function($query) use ($pref_name, $city) {
            //         $query->where('address1', 'like', addslashes($pref_name));
            //         $query->where('address2', 'like', addslashes($city));
            //     })
            //     ->paginate($disp);
            // }
            
            // $shops = Shops::paginate($disp);
        // }

        $params = [
            'tags' => is_array($request->tags) ? $request->tags : [],
        ];

        // $shops->get();

        // info/search.blade.php ファイルを渡す
        // return view('info.search', ['shops' => $shops, 'keyword' => $keyword, 'disp' => $disp, 'form' => $form]);
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

    public function searchPref(Request $request)
    {
        $url = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=".$request->prefecture_id;
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $arr = json_decode($json,true);
        return $arr;
    }

    public function ranking(Request $request)
    {
        // info/ranking.blade.php ファイルを渡す
        return view('info.ranking');
    }
}
