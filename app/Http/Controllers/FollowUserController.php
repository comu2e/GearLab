<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use Illuminate\Http\Request;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FollowUserController extends Controller
{

    public function store($id)
    {
//        $followedUser = User::findOrFail($request->input('user_id'));
        $followedUser = User::findOrFail($id);
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
        return response()->json(['result' => false]);
    }

    public function following_check(User $user)
    {
        $auth_id = Auth::id();
        $data = '';
        if ($auth_id != $user->id) {
            if ($user->isFollowedBy($user)) {
                $data = true;
            }
            else{
                $data=false;
            }

        }
        return $data;


    }

}
