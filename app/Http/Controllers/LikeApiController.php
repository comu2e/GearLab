<?php


namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;
use App\Http\Requests\GearRequest;

class LikeApiController extends Controller
{
    public function like($id,$auth_id)
    {

        Like::create([
            'gear_id' => $id,
            'user_id' => $auth_id,
        ]);

       return "Liked";
    }

    public function unlike($id,$auth_id)
    {
        $like = Like::where('gear_id', $id)->where('user_id', $auth_id)->first();
        $like->delete();
        return "Unliked";
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function show_index($user_id)
    {

        $likes = Gear::where('user_id',$user_id)->get();
        return response()->json([
            'message' => 'ok',
            'data' => $likes
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}
