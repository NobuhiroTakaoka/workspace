<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required'
    );

    protected $fillable = ['name', 'gender', 'hobby', 'introduction'];  // Laravel15 課題5 追加（$fillableプロパティのホワイトリストの設定にカラムを追加）
}
