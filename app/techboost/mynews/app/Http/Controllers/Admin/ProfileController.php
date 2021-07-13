<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;  // 自動追記

class ProfileController extends Controller
{
    public $genders = ['男性','女性'];  // Laravel14 課題4 追加

    // addアクション
    public function add()
    {
        $genders = $this->genders;  // Laravel14 課題4 追加（メソッド外の連想配列$gendersをこのメソッド変数に格納）
        
        return view('admin.profile.create', ['genders' => $genders]);  // Laravel14 課題4 追加（プロフィール新規作成ページに渡す戻り値に連想配列$gendersを追加）
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Profile::$rules);  // Laravel15 課題5

        $profile = new Profile;
        $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $profile->fill($form);
        $profile->save();

        // admin/profile/createにリダイレクトする
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)  // Laravel17 課題1 変更（引数にRequestクラスの変数$requestを追加）
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        $genders = $this->genders;  // Laravel17 課題1 追加（メソッド外の連想配列$gendersをこのメソッド変数に格納）

        // return view('admin.profile.edit');
        return view('admin.profile.edit', ['profile_form' => $profile], ['genders' => $genders]);  // Laravel17 課題1 変更（プロフィール編集画面ページに渡す戻り値を追加）
    }

    public function update(Request $request)  // Laravel17 課題1 変更（引数にRequestクラスの変数$requestを追加）
    {
        // Varidationを行う
        $this->validate($request, Profile::$rules);
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($profile_form['_token']);

        // データベースに保存する
        $profile->fill($profile_form);
        $profile->save();
        
        // （仮）admin/profile/createにリダイレクトする
        return redirect('admin/profile/create');
    }
}
