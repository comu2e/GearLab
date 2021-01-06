<?php


namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Models\Gear;

use Storage;


class FavoriteController extends Controller
{
  

    public function store($id)
    {
        $gear = Gear::find($id);
        $gear->user()->attach(Auth::id());
        $count = $gear->user()->count(); //以下追加
        return response()->json([
            'count' => $count,
        ]);
    }

// 省略
    public function destroy($id)
    {
        $gear = Gear::find($id);
        $gear->user()->detach(Auth::id());
        $count = $gear->user()->count(); //以下追加
        return response()->json([
            'count' => $count,
        ]);
    }

    public function count($id)
    {
        $gear = Gear::find($id);
        $count = $gear->user()->count();
        return response()->json($count);
    }

    public function hasfavorite($id)
    {
        $gear = Gear::find($id);
        if ($gear->user()->where('user_id', Auth::id())->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
