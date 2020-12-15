<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\FollowUser;
use App\Models\User;

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
