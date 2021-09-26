<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;  // 追記

class ShopController extends Controller
{
    public function add(Request $request)
    {
        // member/shop/entry.blade.php ファイルを渡す
        return view('member.shop.entry');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Shops::$rules);

        $shop = new Shops;
        $form = $request->all();

        // データベースに保存する
        $shop->fill($form);
        $shop->save();
        
        // member/shop/entryにリダイレクトする
        return redirect('member/shop/entry');
    }
}
