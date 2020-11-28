<?php


namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;
use App\Http\Requests\GearRequest;

class GearApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gear = Gear::all();
        return response()->json([
            'message' => 'ok',
            'data' =>  $gear
        ], 200, [], JSON_UNESCAPED_UNICODE);    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GearRequest $request)
    {
        $gear = Gear::create($request->all());
        return response()->json([
            'message' => 'Gear created successfully',
            'data' => $gear,
        ],
            201, [],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gear = Gear::find($id);
        if ($gear) {
            return response()->json([
                'message' => 'ok',
                'data' => $gear
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(GearRequest $request,$id)
//    {
//        $update = [
//            'gear_name' => $request-> gear_name,
//            'user_id' => Auth::id(),
//            'maker_name' => $request-> maker_name,
//            'content' => $request-> content,
//            'updated_at' => date('Y/m/d H:i:s'),
//            'gear_name' => date('Y/m/d H:i:s'),
//        ];
//        $gear = Gear::where('id', $id)->update($update);
//        if ($gear) {
//            return response()->json([
//                'message' => 'Book updated successfully',
//            ], 200);
//        } else {
//            return response()->json([
//                'message' => 'Book not found',
//            ], 404);
//        }
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gear = Gear::where('id', $id)->delete();
        if ($gear) {
            return response()->json([
                'message' => 'Gear deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }
    }
}
