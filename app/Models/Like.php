<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['gear_id','user_id'];

    public function gear()
    {
        return $this->belongsToMany(Gear::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
