<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public static $rules = array(
        'title' => 'required',
        'body' => 'required'
    );

    protected $fillable = ['title', 'body'];  // 追加（$fillableプロパティのホワイトリストの設定にカラムを追加）

    // News Modelに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
}
