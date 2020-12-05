<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\User;
use Illuminate\Http\Request;

class FollowApiController extends Controller
{
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
