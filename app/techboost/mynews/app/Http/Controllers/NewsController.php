<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;  // 追記

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        // $cond_title が空白でない場合は、記事を検索して取得する（※一般ユーザ用の一覧ページ未実装）
        if ($cond_title != '') {
            // あいまい検索の実装を追加
            $posts = News::where('title', 'like', '%' . $cond_title . '%')->orderBy('updated_at', 'desc')->get();
        } else {
            $posts = News::all()->sortByDesc('updated_at');
        }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

     // news/index.blade.php ファイルを渡している
     // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
}
