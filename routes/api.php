<?php

use App\Models\Gear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/gears', 'App\Http\Controllers\GearApiController',['except' => ['update']]);

Route::post('file_upload',function(\App\Http\Requests\GearRequest $request){
    $gear = new Gear;

    $gear -> gear_name= $request-> gear -> gear_name;
    $gear -> user_id = \Illuminate\Support\Facades\Auth::id();

    $gear -> gear_category =  $request-> gear ->  gear_category ;
    $gear -> maker_name= $request-> gear ->  maker_name;
    $gear -> content =  $request-> gear ->  content;
    $gear -> updated_at = date('Y/m/d H:i:s');
    $gear -> edited_at = date('Y/m/d H:i:s');


//    $gear = Gear::create($request->all());

    $file = request()->file;
    $file_name = request()->file->getClientOriginalName();
    $path = Storage::disk('s3')->putFileAs('/myprefix', $file, $file_name,'public');
    $s3_url = Storage::disk('s3')->url($path);

//    request()->file->storeAs('public/',$file_name);

    $gear -> image_url = $s3_url;

    $gear->save();
//    return redirect('api/file_upload');

    return response()->json([
        'message' => 'Gear created successfully',
        'data' => $gear,
    ],
        201, [],
        JSON_UNESCAPED_UNICODE
    );


});
