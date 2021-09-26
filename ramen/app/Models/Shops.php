<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    use HasFactory;
    
    // $guardedプロパティの設定にカラムを追加
    protected $guarded = ['id'];

    // validationのルールを設定する項目を追加
    public static $rules = array(
        'shop_name' => 'required',
    );
}
