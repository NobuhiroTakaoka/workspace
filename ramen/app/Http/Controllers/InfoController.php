<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;  // 追記

class InfoController extends Controller
{
    public function index(Request $request)
    {
        // info/index.blade.php ファイルを渡す
        return view('info.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword != '') {
            // 検索されたら検索結果を取得する →あいまい検索+SQLインジェクション対策の実装を追加
            $posts = Shops::where('shop_name', 'like', '%' .  addslashes($keyword) . '%')->get();
        } else {
            // それ以外はすべてのお店を取得する
            $posts = Shops::get();
        }

        // info/search.blade.php ファイルを渡す
        return view('info.search', ['posts' => $posts, 'keyword' => $keyword]);        
    }

    public function ranking(Request $request)
    {
        // info/ranking.blade.php ファイルを渡す
        return view('info.ranking');
    }
}
