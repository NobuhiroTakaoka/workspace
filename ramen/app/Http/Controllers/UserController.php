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

        // 取得したレコードのニックネームが空文字、または取得できない（null）場合は非公開に設定
        if (empty($profile[0]->nickname)) {
            $profile[0]->nickname = '非公開';
        }

        // レコードを取得できない（null）の場合は、性別を非公開に設定
        if (empty($profile[0]->gender)) {
            $profile[0]->gender = '非公開';
        }

        // レコードを取得できない（null）の場合は、誕生年を非公開に設定
        if (empty($profile[0]->birth_year)) {
            $profile[0]->birth_year = '非公開';
        }

        // レコードを取得できない（null）の場合は、出身地を非公開に設定
        if (empty($profile[0]->base)) {
            $profile[0]->base = '非公開';
        }

        // 取得したレコードのプロフィール画像が空文字、または取得できない（null）場合は空文字を設定
        if (empty($profile[0]->nickname)) {
            $profile[0]->nickname = '';
        }

        // 取得したレコードの自己紹介が空文字、または取得できない（null）場合は非公開に設定
        if (empty($profile[0]->introduction)) {
            $profile[0]->introduction = '非公開';
        }

        return view('user.profile_detail', ['profile' => $profile, 'user' => $user,]);
    }
}
