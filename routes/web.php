<?php
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

Route::get('/', 'PostController@home');

Auth::routes();

// Social Login
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account', 'HomeController@myAccount')->name('myaccount');
Route::get('/account/edit', 'HomeController@editAccount')->name('editaccount');
Route::get('/account/post', 'HomeController@myPost')->name('mypost');
Route::get('/account/inbox', 'HomeController@inbox')->name('inbox');
Route::post('/avatar/edit', 'HomeController@avatar_update')->name('avatar.update');
Route::post('/profile/edit/{id}', 'HomeController@updateAccount')->name('profile.update');
// Inbox
Route::post('/message', 'HomeController@sendMessage')->name('send-message');

Route::get('/contacts', 'HomeController@get');
Route::get('/conversation/{id}', 'HomeController@getMessageFor');
Route::post('/conversation/send', 'HomeController@send');



// Post
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function(){
    Route::post('create_post', 'PostController@createPost');
});
// Post Image API-axios
Route::get('get_all', 'PostController@getAllPosts');
Route::post('/images-upload', 'PostController@imageUpload');

// Likes Routes
Route::get('post/{id}/islikedbyme', 'PostController@isLikedByMe');
Route::post('post/like', 'PostController@like')->name('like.dislike');


// Admin
Route::get('/admin/dashboard', 'AdminController@index');

// Public Profile
Route::get('/account/{id}', 'UserController@profile')->name('public-profile');
