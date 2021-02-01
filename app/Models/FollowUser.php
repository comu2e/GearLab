<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FollowUser extends Pivot
{
    protected $table = 'follow_users';
    protected $guarded = [];
    protected $fillable = ['followed_user_id','user_id'];
}
