<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function add(Request $request)
    {
        // shop/detail.blade.php ファイルを渡す
        return view('shop.detail');
    }
}
