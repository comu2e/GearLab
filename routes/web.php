<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home');
});

Route::get('/concept', function () {
    return view('concept');
});

Route::get('/user_detail/{id?}', function () {
    return view('user_detail_view')->name('user_detail');
});


Auth::routes();

Route::resource('users','App\Http\Controllers\UserController');
Route::resource('gears','App\Http\Controllers\GearController');

Route::get('users/{user_id}/gear_category={gear_category}','App\Http\Controllers\GearController@category_index');

Route::get('edit/{id}', 'App\Http\Controllers\GearController@edit_gear')->name('gear_edit');
Route::post('edit/{id}', 'App\Http\Controllers\GearController@update_gear')->name('gear_update');
//投稿フォームページ
//Route::group(['middleware' => 'auth'], function() {
//    Route::get('/gears', 'GearController@showCreateForm')->name('posts.create');
//    Route::post('/gears', 'GearController@create');
//});
//いいね
Route::get('/gear/{id}', 'App\Http\Controllers\GearController@like')->name('gear.like');
Route::get('/gear/unlike/{id}', 'App\Http\Controllers\GearController@unlike')->name('gear.unlike');
