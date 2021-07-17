<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public static $rules = array(
        'news_id' => 'required',
        'edited_at' => 'required',
    );

    protected $fillable = ['news_id', 'edited_at'];  // 追加（$fillableプロパティのホワイトリストの設定にカラムを追加）
}
