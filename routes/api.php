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
//API認証用のmiddleware
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'App\Http\Controllers\LoginController@login');
//GearのAPI
Route::apiResource('/gears', 'App\Http\Controllers\GearApiController');
Route::apiResource('/likes', 'App\Http\Controllers\LikeApiController', ['only' => ['show_index']]);

//いいね
Route::get('/likes/{gear_id}/{user_id}', 'App\Http\Controllers\LikeApiController@like');
Route::get('/unlikes/{gear_id}/{user_id}', 'App\Http\Controllers\LikeApiController@unlike');

Route::get('/user_id={user_id}','App\Http\Controllers\GearApiController@user_index');
Route::post('/follow-users/{user_id}','App\Http\Controllers\FollowUserController@store');
Route::delete('/follow-users/{user_id}/{auth_id}','App\Http\Controllers\FollowUserController@destroy');

Route::group(['middleware' => 'web'], function () {
    Route::apiResource('/follows', 'App\Http\Controllers\FollowUserController', ['only' => ['show']]);
});


Route::get('/get_token', function (Request $request) {
    $user = App\Models\User::find($request->id);
    $token = $user->createToken('token_for_user1')->accessToken;
    return response()->json(['token' => $token]);
});
