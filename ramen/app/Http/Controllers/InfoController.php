<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        // info/index.blade.php ファイルを渡している
        return view('info.index');
    }
}
