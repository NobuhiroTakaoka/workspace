<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーションのためのメソッドを追加
    public function profiles()
    {
        // hasOne（１対１）を定義し、外部キー（user_id）、ローカルキー（id）にオーバーライド
        return $this->hasOne(Profiles::class, 'user_id', 'id');
    }

    public function shops()
    {
        // hasMany（１対多）を定義し、外部キー（user_id）、ローカルキー（id）にオーバーライド
        return $this->hasMany(Shops::class, 'user_id', 'id');
    }

    public function reviews()
    {
        // hasMany（１対多）を定義し、外部キー（user_id）、ローカルキー（id）にオーバーライド
        return $this->hasMany(Reviews::class, 'user_id', 'id');
    }
}
