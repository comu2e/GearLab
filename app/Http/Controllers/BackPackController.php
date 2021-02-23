<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackPack;
use Illuminate\Support\Facades\Log;

class BackPackController extends Controller
{
// Create a new contents_arr entry.
    public function hello()
    {
        return response()->json([
            'status' => 'success',
            'data' => "hello"
        ]);
    }

    public function createContents(Request $request)
    {
        Log::debug('API storeメソッドの実行');
        Log::debug($request);
        Log::debug(request());
        $backpacks = BackPack::create([
//            テストここにgear_idを追加していく
            'user_id'=>1,
            'arr_gear' => ['Toni Abbah', 'Anastacia Mast', 'Soji Igbonna'],
        ]);
        if ($backpacks) {
            return response()->json([
                'status' => 'success',
                'data' => $backpacks
            ], 200);
        }

            return response()->json([
                'status' => 'fail',
                'message' => 'failed to create content_arr record'
            ], 500);
        }

}
