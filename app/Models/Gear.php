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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isLiked($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }
    public function getLike($user_id,$gear_id)
    {
        return $this->where('user_id', $user_id)->where('id',$gear_id);
    }

    public function getUser($user_id)
    {
        return $this->find($user_id)
            ->gears()
            ->get();
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();

        $likers = array();
        foreach($this->likes as $like) {
            array_push($likers, $like->user_id);
        }

        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}
