<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Profile;  // 追記

class Profiles extends Model
{
    use HasFactory;

    // $guardedプロパティの設定にカラムを追加
    protected $guarded = ['id'];
}
