<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;  // 追記
use App\Models\History;  // 追記
use Carbon\Carbon;  // 追記

class NewsController extends Controller
{
    // addアクション
    public function add()
    {
        return view('admin.news.create');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, News::$rules);

        $news = new News;
        $form = $request->all();

        // フォームから画像が送信されてきたら、$news->image_path に画像のパスを格納
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $news->fill($form);
        $news->save();
        
        // admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する →あいまい検索+SQLインジェクション対策の実装を追加
            $posts = News::where('title', 'like', '%' .  addslashes($cond_title) . '%')->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $news = News::find($request->id);
        if (empty($news)) {
            abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, News::$rules);
        // News Modelからデータを取得する
        $news = News::find($request->id);
        // 送信されてきたフォームデータを格納する
        $news_form = $request->all();
        if ($request->remove == 'true') {  // フォームから「画像を削除」が送信されてきたら、$news->image_path の画像のパスにnullを格納
            // $news_form['image_path'] = null;  // カリキュラムの誤り？？
            $news->image_path = null;  // 追加（カリキュラムの修正）
        } elseif ($request->file('image')) {  // フォームから画像が送信されてきたら、$news->image_path の画像のパスを上書きして格納
            $path = $request->file('image')->store('public/image');
            // $news_form['image_path'] = basename($path);  // カリキュラムの誤り？？
            $news->image_path = basename($path);  // 追加（カリキュラムの修正）
        }
        // カリキュラムの誤り？？であるなら、以下の条件分岐は更新の有無をsaveメソッドで判断するため、必要なし
        // } else {
        //     $news_form['image_path'] = $news->image_path;
        // }
        // フォームから送信されてきたimageを削除する
        unset($news_form['image']);
        // フォームから送信されてきたremoveを削除する
        unset($news_form['remove']);
        // フォームから送信されてきた_tokenを削除する
        unset($news_form['_token']);

        // 該当するデータを上書きして保存する（短縮形の書き方）
        $news->fill($news_form)->save();

        // History Modelに編集履歴の登録を実装
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/news');
    }

    public function delete(Request $request)
    {
        // News Modelからデータを取得する
        $news = News::find($request->id);
        // 該当するデータを削除する
        $news->delete();

        return redirect('admin/news');
    }
}
