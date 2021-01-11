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

    public function favorites()
    {
        return $this->belongsToMany(Gear::class)->withTimestamps();
    }
//ユーザー（User）-> 中間テーブル（FollowUser)<-フォローされるユーザー（User followed_user_id）
    public function followUsers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')
            ->using(FollowUser::class);
    }
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')->withTimestamps();
    }

    public function isFollowedBy($user_id)
    {
        return $this->followers->where('user_id', $user_id)->count();

    }
    public function getFollowed($user_id,$followed_user_id)
    {
        return $this->followers->where('user_id','=',$user_id)->where('followed_user_id','=',$followed_user_id);
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
