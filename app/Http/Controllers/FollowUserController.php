<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FollowUser;
class FollowUserController extends Controller
{
//    フォローとフォロー解除用のメソッドを追加します。
    public function store(Request $request)
    {
        $followedUser = User::findOrFail($request->input('id'));
        FollowUser::firstOrCreate([
//            'user_id' => Auth::id(),
            'user_id' => $request ->user_id,
            'followed_user_id' => $followedUser->id,
        ]);
        return response()->json(['result' => true]);
    }

    public function destroy(Request $request,$id)
    {
        $followedUser = User::findOrFail($id);
//        $user = Auth::user();
        $user = $request->user;
//        'user_id' => $request->user_id(),

        $user->followUsers()->detach($followedUser->id);
        return response()->json(['result' => true]);
    }

    public function show($user_id)
    {
        $follow_user = User::where($user_id);
        if ($follow_user) {
            return response()->json([
                'message' => 'ok',
                'data' => $follow_user
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }
    }
}
