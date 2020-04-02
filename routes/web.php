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

// Admin Login
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('admin');
Route::view('/admin', 'admin.index');

// Social Login
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account/edit', 'HomeController@editAccount')->name('editaccount');
Route::get('/account/post', 'HomeController@myPost')->name('mypost');
Route::delete('post/{id}', 'HomeController@postDelete')->name('deletemypost');
Route::get('/account/inbox', 'HomeController@inbox')->name('inbox');
// My Events / Add New Event
Route::get('/account/events/', 'HomeController@myEvents')->name('myEvents');
Route::get('single', 'HomeController@singleEvent')->name('singleEvent');

Route::get('/account/{username}', 'HomeController@myAccount')->name('myaccount');
Route::post('/avatar/edit', 'HomeController@avatar_update')->name('avatar.update');
Route::post('/profile/edit/{id}', 'HomeController@updateAccount')->name('profile.update');
// Inbox
Route::post('/message', 'HomeController@sendMessage')->name('send-message');

Route::get('/contacts', 'HomeController@get');
Route::get('/conversation/{id}', 'HomeController@getMessageFor');
Route::post('/conversation/send', 'HomeController@send');

// Blog
Route::get('articles', 'BlogController@index')->name('blog');

// Post
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function(){
    Route::post('create_post', 'PostController@createPost');
});
// Community
Route::get('/get_community', 'CommunityController@get_community');
Route::get('/all_community', 'CommunityController@all_community');
Route::get('/c/{slug}', 'CommunityController@single')->name('community');

// Post Routes API-axios
Route::get('new/post', 'PostController@newPost')->middleware('auth');
Route::get('get_all', 'PostController@getAllPosts');
Route::post('/images-upload', 'PostController@imageUpload');
Route::get('/p/{slug}', 'PostController@single')->name('singlePost');
Route::get('api-podcasts', 'PostController@ApiPodcast');
Route::get('all/podcasts', 'PostController@getPodcast')->name('podcast');

// Likes Routes
Route::post('favorite/{post}', 'PostController@favoritePost');
Route::post('unfavorite/{post}', 'PostController@unFavoritePost');
Route::get('my_favorites', 'UserController@myFavorites')->middleware('auth')->name('savedpost');

// Public Profile
Route::get('/{username}', 'UserController@profile')->name('public-profile');

