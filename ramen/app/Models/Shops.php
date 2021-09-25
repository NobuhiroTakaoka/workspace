<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    use HasFactory;

    public static $rules = array(
        'shop_name' => 'required'
    );

    // $fillableプロパティのホワイトリストの設定にカラムを追加
    protected $fillable = ['shop_name'];
}
