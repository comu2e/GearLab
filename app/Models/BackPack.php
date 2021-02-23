<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackPack extends Model
{
    protected $fillable = ['arr_gear'];

//    use HasFactory;
    protected $casts = ['arr_gear' => 'array'];
}
