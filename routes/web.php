<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

if (config('app.env') === 'production') {
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

Route::post('/admin/user/{id}', 'GearController@delete');

//ログインしたときに表示
Route::group(['middleware' => 'auth'], function () {

//フォロー機能



    Route::get('/user_detail/{id?}', function () {
        return view('user_detail_view')->name('user_detail');
    });

    Route::resource('users', 'UserController');
    Route::resource('gears', 'GearController', ['except' => ['create', 'update']]);

    Route::get('edit/{id}', 'GearController@edit_gear')->name('gear_edit');
    Route::post('edit/{id}', 'GearController@update_gear')->name('gear_update');
//フォロー]

    Route::prefix('gears')->name('gears.')->group(function () {

        Route::get('/{gear}/check', 'LikeController@check')->name('like.check');
        Route::get('/{gear}/liked', 'LikeController@index')->name('like.index');
        Route::resource('/{gear}/likes', 'LikeController', [
            'only' => ['store'],
        ]);


    });


});
