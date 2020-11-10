<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
//    Repositoryパターンで書き直す
    public static function index()
    {
        return User::all();
    }


}
