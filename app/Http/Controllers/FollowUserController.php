<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use Illuminate\Http\Request;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowUserController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        $following_user = $user -> get_followings();
        return response()->json([
            'data' => $following_user,
        ]);
    } public function show($user_id)
    {
        $user = User::find($user_id);

        return response()->json([
            'data' => $user,
        ]);
    }

//    認証しているユーザが対象のユーザーをフォローしているかを確認するためのメソッド
    public function isFollowingcheck(User $user)
    {
//        認証しているユーザーの情報
        $auth_id = Auth::id();
        $data = '';
        if ($auth_id != $user->id) {
            if ($user->is_following($auth_id)) {
                $data = 1;
            }
            else{
                $data=0;
            }

        }
        return $data;


    }

    public function store(Request $request)
    {
        $followedUser = User::findOrFail($request->input('id'));
        FollowUser::firstOrCreate([
            'user_id' => Auth::id(),
            'followed_user_id' => $followedUser->id,
        ]);
        return response()->json(['result' => true]);
    }

    public function destroy($id)
    {
        $followedUser = User::findOrFail($id);
        $user = Auth::user();
        $user->followUsers()->detach($followedUser->id);
        return response()->json(['result' => true]);
    }
}
