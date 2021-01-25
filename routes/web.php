<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

    // asset()やurl()がhttpsで生成される
    URL::forceScheme('http');
/*
|--------------------------------------------------------------------------
| Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/layouts.landing', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('/layouts.landing');

});
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::get('/home', function () {
    return redirect('/gears');
});
Route::get('/resume', function () {
    return view('/layouts.resume.resume');
});

Auth::routes();

Route::group(['middleware' => ['auth.admin']], function () {

    //管理側トップ
    Route::get('/admin', 'admin\AdminTopController@show');
    //ログアウト実行
    Route::post('/admin/logout', 'admin\AdminLogoutController@logout');


    //ユーザー一覧
    Route::get('/admin/user_list', 'admin\ManageUserController@showUserList');
    //ユーザー詳細
    Route::get('/admin/user/{id}', 'admin\ManageUserController@showUserDetail');
    Route::post('/admin/user/{id}', 'admin\ManageUserController@delete');

});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');
Auth::routes();


//ルートの保護
Route::get('profile', function () {
    // 認証済みのユーザーのみが入れる
})->middleware('auth');

Route::post('/admin/user/{id}', 'GearController@delete');
Route::get('/following/{user_id}','FollowUserController@index');

//ログインしたときに表示
Route::group(['middleware' => 'auth'], function () {
//フォロー機能

//フォロー]
    Route::prefix('follows')->name('follows.')->group(function () {

        Route::get('/{user}/followed', 'FollowUserController@index')->name('follow.index');
        Route::resource('/{user}/follows', 'FollowUserController', [
            'only' => ['store'],
        ]);
        Route::get('/{user}/check', 'FollowUserController@check')->name('follow.check');


    });
    Route::get('/user_detail/{id?}', function () {
        return view('user_detail_view')->name('user_detail');
    });

    Route::resource('users', 'UserController');
    Route::resource('gears', 'GearController', ['except' => ['create']]);

//    Route::post('/gears','GearController@store');
//    Route::put('/gears','GearController@update');
//Route::post('gears','GearController@post');

    Route::get('edit/{id}', 'GearController@edit_gear')->name('gear_edit');
    Route::post('edit/{id}', 'GearController@update_gear')->name('gear_update');
//いいね
    Route::prefix('gears')->name('gears.')->group(function () {

        Route::get('/{gear}/check', 'LikeController@check')->name('like.check');
        Route::get('/{gear}/liked', 'LikeController@index')->name('like.index');
        Route::resource('/{gear}/likes', 'LikeController', [
            'only' => ['store'],
        ]);


    });


});
