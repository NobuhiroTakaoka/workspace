<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTags extends Model
{
    use HasFactory;

    // $fillableプロパティの設定にカラムを追加
    protected $fillable = ['shop_id', 'tag_id'];
}
