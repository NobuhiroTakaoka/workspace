<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;  // 追記
use Illuminate\Support\Facades\Auth;  // 追記
use App\Commons\MasterCommons;  // 追記
use App\Models\Profiles;  // 追記
use App\Models\Prefectures;  // 追記

class UserController extends Controller
{
    // プロフィール編集フォームデータの配列を定義
    public $forms = 
    [  
        'nickname',
        'gender',
        'birth_year', 
        'base', 
        'image_path',
        'introduction',
    ];

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
                                ->orWhere('reviews.points', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('reviews.created_at', 'like', '%' .  addslashes($keyword) . '%')
                                ->orWhere('reviews.updated_at', 'like', '%' .  addslashes($keyword) . '%');
                });
            })    
            ->orderByDesc('reviews.created_at')
            ->paginate($disp);

        return view('member.user.mypage', ['my_reviews' => $my_reviews, 'keyword' => $keyword, 'disp' => $disp]);
    }

    public function profilePublic(Request $request)
    {        
        // ログイン中のユーザIDを取得
        $user_id = Auth::id();

        return view('member.user.profile_public', ['user_id' => $user_id]);
    }

    public function profileEdit(Request $request)
    {        
        // ログイン中のユーザIDを取得
        $user_id = Auth::id();

        // $user_idのprofilesテーブルのレコードを取得
        $profile = Profiles::select()->find($user_id);

        // レコードが存在しない場合は空の配列を設定
        if (empty($profile)) {
            $profile = [];
        }

        // Prefecturesモデルクラスをインスタンス化
        $pref = new Prefectures();

        if (!empty($pref_id)) {
            // $prefectureのshopsテーブルのレコードを取得
            $pref_rec = $pref::select()->find($pref_id);
            $pref_name = $pref_rec->pref_name;
        } else {
            $pref_name = '';
        }

        return view('member.user.profile_edit', ['profile' => $profile, 'user_id' => $user_id, 'genders' => $this->genders, 'pref_name' => $pref_name,]);
    }
}
