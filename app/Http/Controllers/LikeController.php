<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Gear;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function index($user_id)
    {
        $user = User::find($user_id);
        $liked_gear_id_list = Like::where('user_id',$user_id)->get(['gear_id']);
        $gear_id_list = [];
        foreach ($liked_gear_id_list as $gear_list){
                   array_push($gear_id_list,$gear_list->gear_id);
        }
        $liked_gear = Gear::whereIn('id', $gear_id_list)->get();

        return response()->json([
            'data' => $liked_gear,
            'user'=>$user->name
        ]);
    }
    public function store(Gear $gear)
    {
        $user = Auth::user();
        $data = '';
        if ($user->id != $gear->user_id) {
            if ($gear->isLiked(Auth::id())) {
                // 対象のレコードを取得して、削除する。
                $delete_record = $gear->getLike($user->id,$gear->id)->first()->id;
                $data = $delete_record;

                Like::destroy($data);
            } else {
                $like = Like::firstOrCreate(
                    array(
                        'user_id' => Auth::user()->id,
                        'gear_id' => $gear->id
                    )
                );
                $data = $like;

            }
        }
        return $data;
    }
//    認証しているユーザが対象のギアをいいねしているかを確認するためのメソッド

    public function check(Gear $gear)
    {
        $user = Auth::user();
        $data = '';
        if ($user->id != $gear->user_id) {
            if ($gear->isLiked(Auth::id())) {
                $data = 1;
            }
            else{
                $data=0;
            }

        }
        return $data;


    }

}
