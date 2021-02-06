<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gear;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    function showUserList()
    {
        $user_list = User::orderBy("id", "desc")->paginate(10);
        return view("admin.user_list", [
            "user_list" => $user_list
        ]);
    }

    function showUserDetail($id)
    {
        $user = User::find($id);
        return view("admin.user_detail", [
            "user" => $user
        ]);
    }

    function delete($id)
    {
        User::find($id)->delete();
//        ユーザー削除時にそのギアも削除する。
        Gear::where('user_id',$id)->delete();
        return redirect('/admin/user');

    }
}
