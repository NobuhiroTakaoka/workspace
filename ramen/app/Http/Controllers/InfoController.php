<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        // info/index.blade.php ファイルを渡す
        return view('info.index');
    }

    public function search(Request $request)
    {
        // info/search.blade.php ファイルを渡す
        return view('info.search');        
    }

    public function ranking(Request $request)
    {
        // info/ranking.blade.php ファイルを渡す
        return view('info.ranking');
    }
}
