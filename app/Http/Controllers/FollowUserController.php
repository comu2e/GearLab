<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FollowUserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $following_user = $user->followers;
        return response()->json(['data' => $following_user]);
    }

    public function store($user_id)
    {
        $user = Auth::user();
        $auth_user_id = Auth::id();
//        $following_user = User::find($user_id);
        $following_user = FollowUser::where('user_id',$auth_user_id)->get();

        $isFollowedByAuth =$following_user->where('followed_user_id',$user_id)->count();
//        $data = $isFollowedByAuth;

        $data = '';
        if ($auth_user_id !== $user_id) {
            if ($isFollowedByAuth) {
                // 対象のレコードを取得して、削除する。

//                $delete_record = $following_user->getFollowed($auth_user_id, $user_id)->first()->id;
//                $data = $delete_record;

                FollowUser::destroy($data);
            } else {
                $follow = FollowUser::firstOrCreate(
                    array(
                        'user_id' => $auth_user_id,
                        'followed_user_id' => $user_id
                    )
                );
                $data = $follow;


            }
        }
        return $data;

    }


    public
    function check($user_id)
    {
        $user = Auth::user();
        $auth_user_id = Auth::id();

        $following_user = FollowUser::where('user_id',$auth_user_id)->get();

        $isFollowedByAuth =$following_user->where('followed_user_id',$user_id)->count();
//        $data = $isFollowedByAuth;

        if ($auth_user_id != $user_id) {
            if ($isFollowedByAuth) {
                $data = 1;
            } else {
                $data = 0;
            }

        }
        return $data;
    }
}
