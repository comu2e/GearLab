<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Gear extends Model
{
    public $timestamps = false;

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
    const UPDATED_AT = null;
    const CREATED_AT = null;
    public function likes()
    {
        return $this->hasMany(Like::class, 'gear_id');
    }
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function getUser($user_id)
    {
        return $this->find($user_id)
            ->gears()
            ->get();
    }

//postにLikeあるか判定
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
