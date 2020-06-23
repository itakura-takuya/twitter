<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    // timestampの無効化
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * remember_tokenがカラムにないテーブルでAuth::logout時に存在しないremember_tokenが更新しようとしてエラーになるので無視する
     */
    public function setAttribute($key, $value)
    {
        if ($key !== $this->getRememberTokenName()) {
            parent::setAttribute($key, $value);
        }
    }

    public function index()
    {
        $user = new User;
    }

    /***************************************
     * フォロー機能
     **************************************/
    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }
    // リレーションの関係
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_id', 'follower_id');
    }
    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()
        ->where('follower_id', $user_id)->first();
    }

    /***************************************
     * フォロー解除機能
     **************************************/
    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        // 紐付け解除
        return $this->follows()->detach($user_id);
    }
    // リレーションの関係
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'follow_id');
    }
    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()
        ->where('follow_id', $user_id)->first();
    }

}
