<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // 追記
use App\Models\Profiles;  // 追記

class UserController extends Controller
{
    public function profileRefer(Request $request, int $user_id)
    {        
        // $user_idのusersテーブルのレコードを取得
        $user = User::select()->find($user_id);
        
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

        return view('user.profile_detail', [
            'profile' => $profile,
            'user' => $user,
        ]);
    }
}
