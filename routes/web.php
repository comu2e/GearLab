<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
if(config('app.env') === 'production'){
    // asset()やurl()がhttpsで生成される
    URL::forceScheme('http');
}
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
//Route::get('/layouts.landing', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('/layouts.landing');
});

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

});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');
Auth::routes();


//ルートの保護
Route::get('profile', function () {
    // 認証済みのユーザーのみが入れる
})->middleware('auth');

Route::get('/favorite', 'GearController@favorite_gear');
Route::post('/admin/user/{id}', 'GearController@delete');
//フォロー機能
//ログインしていないユーザーにもフォロー関係を表示できるようにする
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UserController@followings')->name('followings');
    Route::get('followers', 'UsersController@followers')->name('followers');
});
//ログインしたときに表示
Route::group(['middleware' => 'auth'], function () {


    Route::put('users', 'UserController@rename')->name('rename');

    Route::get('/user_detail/{id?}', function () {
        return view('user_detail_view')->name('user_detail');
    });

    Route::resource('users', 'UserController');
    Route::resource('gears', 'GearController', ['except' => ['create', 'update']]);

//    Route::get('users/{use_id}/gear_category={gear_category}', 'GearController@category_index')->name('gear_category');

    Route::get('edit/{id}', 'GearController@edit_gear')->name('gear_edit');
    Route::post('edit/{id}', 'GearController@update_gear')->name('gear_update');

    Route::prefix('gears')->name('gears.')->group(function () {

        Route::get('/{gear}/favorites', 'FavoriteController@store');
        Route::get('/{gear}/unfavorites', 'FavoriteController@destroy');
        Route::get('/{gear}/countfavorites', 'FavoriteController@count');
        Route::get('/{gear}/hasfavorites', 'FavoriteController@hasfavorite');

//        //いいね
//        Route::get('/like/{id}', 'GearController@like')->name('gear.like');
//        Route::get('/unlike/{id}', 'GearController@unlike')->name('gear.unlike');
        Route::get('/{gear}/check', 'LikeController@check')->name('like.check');
        Route::get('/{gear}/liked', 'LikeController@index')->name('like.index');
        Route::resource('/{gear}/likes', 'LikeController', [
            'only' => ['store'],
        ]);

//フォロー]
        Route::get('/following/{user_id}', 'FollowUserController@index')->name('follow.index');
//    Route::get('/users_show/{user_id}/}', 'FollowUserController@show')->name('follow.show');
        Route::post('/follow-users', 'FollowUserController@store')->name('follow');
        Route::delete('/follow-users/{user_id}', 'FollowUserController@destroy')->name('unfollow');


    });


});
