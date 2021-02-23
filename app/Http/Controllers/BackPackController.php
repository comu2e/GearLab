<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackPack;

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

    public function createContents()
    {
        $backpacks = BackPack::create([
//            テストここにgear_idを追加していく
            'arr_gear' => ['Toni Abbah', 'Anastacia Mast', 'Soji Igbonna'],
        ]);
        if ($backpacks) {
            return response()->json([
                'status' => 'success',
                'data' => $backpacks
            ]);
        }

            return response()->json([
                'status' => 'fail',
                'message' => 'failed to create content_arr record'
            ]);
        }

}
