<?php

use Illuminate\Http\Request;

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

Route::get('/search', 'PostController@search');


Route::group([ 'prefix' => 'auth'], function (){ 
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\AuthController@login');
        Route::post('signup', 'API\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('getuser', 'API\AuthController@getUser');
    });
}); 

// Post
Route::post('posts/create', 'API\PostController@create')->middleware('auth:api');
Route::post('posts/delete', 'API\PostController@delete')->middleware('auth:api');
Route::post('posts/update', 'API\PostController@update')->middleware('auth:api');
Route::get('posts', 'API\PostController@posts');

// Comments
Route::post('comments/create', 'API\CommentController@create')->middleware('auth:api');
Route::post('comments/delete', 'API\CommentController@delete')->middleware('auth:api');
Route::post('comments/update', 'API\CommentController@update')->middleware('auth:api');
Route::post('posts/comments', 'API\CommentController@comments')->middleware('auth:api');

// Like
Route::post('posts/like', 'API\LikesController@like')->middleware('auth:api');