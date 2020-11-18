<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['gear_id','user_id'];

    public function gear()
    {
        return $this->belongsTo('App\Models\Gear');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
