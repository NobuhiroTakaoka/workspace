<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefectures extends Model
{
    use HasFactory;

    // $fillableプロパティの設定にカラムを追加
    protected $fillable = ['prefecture'];

    public static function prefList()
    {
        $prefs = Prefectures::all();
        $preflist = array();
        // $preflist += array(0 => '全国');  // placeholder用の値を追加 

        // $key = 1;  // $preflistの取得時の$keyの初期値
        foreach ($prefs as $key => $pref) {
            $preflist += array($key + 1 => $pref->pref_name);
            // $key += 1;
            // $preflist[] = json_decode(json_encode($pref), true);
        }
        return $preflist;
    }
}
