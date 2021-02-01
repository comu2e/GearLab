<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Gear extends Model
{
    protected $table = "gears";

    protected $fillable = [
        'gear_name',
        'gear_category',
        'maker_name',
        'content',
        'image_url',
        'user_id',

    ];
    use HasFactory;
    //    一体他のリレーション

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function like_ing()
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'user_id', 'followed_user_id')->withTimestamps();
    }
    public function isFollowedBy(?Gear $gear): bool
    {
        var_dump($gear);
        return $gear
            ? (bool)$this->followers->where('id', $gear->user_id)->count()
            : false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isLiked($user_id)
    {
        return $this->likes->where('user_id', $user_id)->count();
    }
    public function getLike($user_id,$gear_id)
    {
        return $this->likes->where('user_id','=',$user_id)->where('gear_id','=',$gear_id);
    }

    public function getUser($user_id)
    {
        return $this->find($user_id)
            ->gears()
            ->get();
    }

}
