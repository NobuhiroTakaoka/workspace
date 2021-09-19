<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function add(Request $request)
    {
        // member/shop/entry.blade.php ファイルを渡す
        return view('member.shop.entry');
    }
}
