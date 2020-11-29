<?php

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

Route::post('file_upload',function(){

    $file = request()->file;
    $file_name = request()->file->getClientOriginalName();
    $disk = Storage::disk('s3')->putFileAs('/myprefix', $file, $file_name,'public');

    request()->file->storeAs('public/',$file_name);

    $user = App\Models\User::find(1);

    $user->update(['file_path' => '/storage/'.$file_name]);

    return $user;
});
