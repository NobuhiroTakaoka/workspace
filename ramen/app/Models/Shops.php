<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopTags;  // 追記

class Shops extends Model
{
    use HasFactory;
    
    // $guardedプロパティの設定にカラムを追加
    protected $guarded = ['id'];

    // validationのルールを設定する項目を追加
    public static $rules = array(
        'shop_name' => 'required',
        'shop_name_kana' => 'required',
        // 'branch' => 'required',
        'postcode' => 'required',
        'address1' => 'required',
        'address2' => 'required',
        'address3' => 'required',
        'address4' => 'required',
        // 'map_lat' => 'required',
        // 'map_long' => 'required',
        'phone_number1' => 'required',
        // 'phone_number2' => 'required',
        'opening_hour1' => 'required',
        // 'opening_hour2' => 'required',
        'holiday' => 'required',
        'seats' => 'required',
        'access' => 'required',
        'parking' => 'required',
        // 'official_site' => 'required',
        // 'official_blog' => 'required',
        // 'facebook' => 'required',
        // 'twitter' => 'required',
        'shop_type' => 'required',
        // 'opening_date' => 'required',
        'menu' => 'required',
        // 'notes' => 'required',
        // 'tags' => 'required',

    );
    
    public function tags()
    {
        // hasMany（１対多）を定義し、外部キー（shop_id）、ローカルキー（id）にオーバーライド
        return $this->hasMany(ShopTags::class, 'shop_id', 'id');
    }

    public function reviews()
    {
        // hasMany（１対多）を定義し、外部キー（shop_id）、ローカルキー（id）にオーバーライド
        return $this->hasMany(Reviews::class, 'shop_id', 'id');
    }
}
