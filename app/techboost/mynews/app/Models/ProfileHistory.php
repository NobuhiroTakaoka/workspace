<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileHistory extends Model
{
    use HasFactory;

    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required',
    );

    protected $fillable = ['profile_id', 'edited_at'];  // 追加（$fillableプロパティのホワイトリストの設定にカラムを追加）
}
