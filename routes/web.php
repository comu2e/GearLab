<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/layouts.landing', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('/layouts.landing');
});
Route::get('/resume', function () {
    return view('/layouts.resume.resume');
});

Auth::routes();

Route::group(['middleware' => ['auth.admin']], function () {

    //管理側トップ
    Route::get('/admin', 'App\Http\Controllers\admin\AdminTopController@show');
    //ログアウト実行
    Route::post('/admin/logout', 'App\Http\Controllers\admin\AdminLogoutController@logout');
    //ユーザー一覧
    Route::get('/admin/user_list', 'App\Http\Controllers\admin\ManageUserController@showUserList');
    //ユーザー詳細
    Route::get('/admin/user/{id}', 'App\Http\Controllers\admin\ManageUserController@showUserDetail');

});

//管理側ログイン
Route::get('/admin/login', 'App\Http\Controllers\admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'App\Http\Controllers\admin\AdminLoginController@login');
Auth::routes();


//ルートの保護
Route::get('profile', function () {
    // 認証済みのユーザーのみが入れる
})->middleware('auth');

Route::get('/favorite', 'App\Http\Controllers\GearController@favorite_gear');
Route::post('/admin/user/{id}', 'App\Http\Controllers\GearController@delete');
//フォロー機能
//ログインしていないユーザーにもフォロー関係を表示できるようにする
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'App\Http\Controllers\UserController@followings')->name('followings');
    Route::get('followers', 'App\Http\Controllers\UsersController@followers')->name('followers');
});
//ログインしたときに表示
Route::group(['middleware' => 'auth'], function () {


    Route::put('users', 'App\Http\Controllers\UserController@rename')->name('rename');

    Route::get('/user_detail/{id?}', function () {
        return view('user_detail_view')->name('user_detail');
    });

    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('gears', 'App\Http\Controllers\GearController');

//    Route::get('users/{use_id}/gear_category={gear_category}', 'App\Http\Controllers\GearController@category_index')->name('gear_category');

    Route::get('edit/{id}', 'App\Http\Controllers\GearController@edit_gear')->name('gear_edit');
    Route::post('edit/{id}', 'App\Http\Controllers\GearController@update_gear')->name('gear_update');

    //いいね
    Route::get('/gear/like/{id}', 'App\Http\Controllers\GearController@like')->name('gear.like');
    Route::get('/gear/unlike/{id}', 'App\Http\Controllers\GearController@unlike')->name('gear.unlike');
    //管理側
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'App\Http\Controllers\UserFollowController@store')->name('follow');
        Route::delete('unfollow', 'App\Http\Controllers\UserFollowController@destroy')->name('unfollow');
    });

});
