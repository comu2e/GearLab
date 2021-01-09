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
        $auth = Auth::user();
        $data = '';
        if (Auth::id() != $user->id) {
            if ($auth->isFollowedBy($user)) {
                $data = true;
            }
            else{
                $data=false;
            }

        }
        return $data;


    }

}
