<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use Illuminate\Http\Request;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FollowUserController extends Controller
{

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
