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

Route::get('get-all', 'HomeController@index');
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('stories/get-all-stories', 'StoriesController@index');
    Route::get('stories/get-all-stories-user', 'StoriesController@userindex');
    Route::post('stories/create-stories', 'StoriesController@store');
    Route::post('stories/update-stories', 'StoriesController@update');

    Route::post('stories/create-comments', 'PostsController@store');
    Route::delete('stories/delete-comment-by-id/{id}', 'PostsController@destroy');
    Route::delete('stories/delete-stroy-by-id/{id}', 'StoriesController@storiesDelete');
    Route::get('stories/unlisted-stroy-by-id/{id}', 'StoriesController@markasunlisted');

    Route::get('get-all-user', 'AdminController@userinfo');
    Route::get('update-user-status/{id}', 'AdminController@userStatus');

    

});
