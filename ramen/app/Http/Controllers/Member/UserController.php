<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記
use App\Commons\MasterCommons;  // 追記
use App\Models\Profiles;  // 追記
use App\Models\Prefectures;  // 追記
use Carbon\Carbon;  // 追記

class UserController extends Controller
{
    // プロフィール編集フォームデータの配列を定義
    // public $forms = 
    // [  
    //     'nickname',
    //     'gender',
    //     'birth_year', 
    //     'base', 
    //     'image_path',
    //     'introduction',
    // ];

    // リストを初期化
    private $genders = [];  // お店のタイプリスト

    // コンストラクタでMasterCommonsクラスより、リストの配列を定義
    public function __construct()
    {
        $this->genders = MasterCommons::$genders;
    }

    // public $key = __CLASS__ . '-pro_edit';  //プロフィール編集セッションのキーを設定

    public function mypage(Request $request)
    {
        // 最初のページアクセス時は表示件数がnullのため、「10」を設定
        $disp = $request->disp ?? 10;

        // 検索キーワードを変数に設定
        $keyword = $request->keyword;
        
        // ログイン中のユーザIDを取得
        $user_id = Auth::id();

        $my_reviews = Reviews::select('reviews.*', 'shops.shop_name', 'shops.branch')
            ->join('shops', 'reviews.shop_id', '=', 'shops.id')
            ->where('reviews.user_id', $user_id)
            ->when($keyword != '', function($query) use ($keyword) {
                return $query->where(function($query2) use ($keyword) {
                    return $query2->orWhere('reviews.menu_title', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('shops.shop_name', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('shops.branch', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('reviews.points', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('reviews.created_at', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('reviews.updated_at', 'like', '%' .  addslashes($keyword) . '%');
                });
            })    
            ->orderByDesc('reviews.created_at')
            ->paginate($disp);

        return view('member.user.mypage', [
            'my_reviews' => $my_reviews,
            'keyword' => $keyword,
            'disp' => $disp,
        ]);
    }

    // public function profilePublic(Request $request)
    public function profilePublic()
    {        
        // ログイン中のユーザIDを取得
        $user_id = Auth::id();
        
        // $user_idのprofilesテーブルのレコードを取得
        $profile = Profiles::where('user_id', $user_id)->get();

        // レコードが存在する場合
        if (isset($profile[0])) {
            // 取得したレコードのニックネームが空文字の場合は非公開に設定
            if (empty($profile[0]->nickname)) {
                $profile[0]->nickname = '非公開';
            }
            // 取得したレコードの自己紹介が空文字の場合は非公開に設定
            if (empty($profile[0]->introduction)) {
                $profile[0]->introduction = '非公開';
            }
        }

        return view('member.user.profile_public', [
            'profile' => $profile,
            'user_id' => $user_id,
        ]);
    }

    // public function profileEdit(Request $request)
    public function profileEdit()
    {        
        // ログイン中のユーザIDを取得
        $user_id = Auth::id();

        // $user_idのprofilesテーブルのレコードを取得
        $profile = Profiles::where('user_id', $user_id)->get();

        // レコードが存在する場合は出身地の判定、存在しない場合は空文字を設定
        if (!empty($profile[0]->user_id)) {
            // 出身地が非公開の場合は空文字を設定、そうでない場合は$pref_idを取得
            if ($profile[0]->base == '非公開') {
                $pref_id = '';
            } else {
                // Prefecturesモデルクラスをインスタンス化
                $pref = new Prefectures();

                // $pref_nameから$pref_idを取得
                $pref_rec = $pref::select()->where('pref_name', $profile[0]->base)->get();
                $pref_id = $pref_rec[0]->id;
            } 
        } else {
            $pref_id = '';
        }

        return view('member.user.profile_edit', [
            'profile' => $profile,
            'user_id' => $user_id,
            'genders' => $this->genders,
            'pref_id' => $pref_id,
        ]);
    }

    public function profileSave(Request $request)
    {
        // リクエストをすべて取得する
        $form = $request->all();

        // ニックネームがnullの場合は空文字を設定
        if (empty($form['nickname'])) {
            $form['nickname'] = '';
        }

        // ニックネームがnullの場合は空文字、それ以外は都道府県名取得して設定
        if (empty($form['base'])) {
            $form['base'] = '非公開';
        } else {
            // Prefecturesモデルクラスをインスタンス化
            $pref = new Prefectures();

            // $pref_idから$pref_nameを取得
            $pref_rec = $pref::select()->find($form['base']);
            $form['base'] = $pref_rec->pref_name;
        }

        // 画像ファイル名が設定されている場合
        if (isset($form['image_file'])) {
            // 画像ファイル名を取得
            // $image_name = $form['image_file']->getClientOriginalName();
            // 画像ファイルを保存
            $path = $request->file('image_file')->store('public/image');
            // 保存した画像ファイルパスからファイル名を取得
            $form['image_path'] = basename($path);
        } else {
            $form['image_path'] = '';
        }

        if (empty($form['introduction'])) {
            $form['introduction'] = '';
        }

        // リクエストされたフォームからtokenを削除する
        unset($form['_token']);

        // ログイン中のユーザIDを取得
        $user_id = Auth::id();

        // データベース登録・更新用に配列を作成
        $data = array('user_id' => $user_id);  // ユーザID
        $data += $form;  // フォームデータ


        // $user_idのprofilesテーブルのレコードを取得
        $profile = Profiles::where('user_id', $user_id)->get();

        // レコードが存在する場合
        if (isset($profile[0])) {
            // 画像ファイル名が設定されていない、かつテーブルのimage_pathが存在、かつ画像ファイル削除にチェックが入っていない場合はテーブルのimage_pathを再設定する
            if ($form['image_path'] == '' && $profile[0]->image_path != '' && !$request->has('image_delete')) {
                $data['image_path'] = $profile[0]->image_path;
            }

            // 画像ファイル名が設定されていない、かつテーブルのimage_pathが存在、かつ画像ファイル削除にチェックが入っている場合はテーブルのimage_pathに空文字を設定する
            if ($form['image_path'] == '' && $profile[0]->image_path != '' && $request->has('image_delete')) {
                $data['image_path'] = '';
            }
        }
        
        // レコードが存在しない場合は空の配列を設定
        if (empty($profile[0])) {
            Profiles::insert([
                'user_id' => $data['user_id'],
                'nickname' => $data['nickname'],
                'gender' => $data['gender'],
                'birth_year' => $data['birth_year'],
                'base' => $data['base'],
                'image_path' => $data['image_path'],
                'introduction' => $data['introduction'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Profiles::where('user_id', $user_id)->update([
                'user_id' => $data['user_id'],
                'nickname' => $data['nickname'],
                'gender' => $data['gender'],
                'birth_year' => $data['birth_year'],
                'base' => $data['base'],
                'image_path' => $data['image_path'],
                'introduction' => $data['introduction'],
                'updated_at' => Carbon::now(),
            ]);
        }

        // マイページにリダイレクトする
        return redirect('member/mypage');
    }
}
