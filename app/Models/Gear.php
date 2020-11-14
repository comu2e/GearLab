<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    use HasFactory;
    //    一体他のリレーション
    public function likes(){
        return $this -> hasMany('App\Models\Like');
    }
}
