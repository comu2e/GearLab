<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    public function gears()
    {
        return $this->hasMany(Gear::class);
    }
//リレーションの設定
//ユーザー（User） 中間テーブル（FollowUser) フォローされるユーザー（User）

    public function followUsers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')
            ->using(FollowUser::class);
    }



    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function follow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;

        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($userId);
        }
    }

    public function unfollow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;

        // すでにフォロー済みならば、フォローを外す
        if ($existing && !$myself) {
            $this->followings()->detach($userId);
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
