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

Route::get('/', 'PostController@home')->name('main');

Auth::routes(['verify' => true]);

/* 
========================================
---------     SEARCH PAGE    -----------
*/
Route::get('/search', 'PostController@DesktopSearch')->name('search-desktop');

/* 
========================================
---------    OTHER PAGES    -----------
*/
Route::get('/privacy', 'PageController@privacy');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');
Route::post('/sendMessage', 'PageController@SendMessage')->name('sendMessage');

/* 
========================================
---------     ADMIN LOGIN    -----------
*/
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'AdminController@index')->name('admin.home');
    Route::post('/updates/new','AdminController@newUpdate')->name('newUpdate');
});

/* 
========================================
----- ALL UPDATES FOR GUEST + AUTH  ----
*/
Route::get('/all/updates', 'UserController@allUpdates')->name('allUpdates');
Route::get('/all/m/updates', 'UserController@allUpdatesMobile')->name('allUpdates.mobile');
Route::get('/updates/{slug}', 'UserController@singleUpdate')->name('singleUpdate');

/* 
========================================
---------     SOCIAL LOGIN   -----------
*/
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account/edit', 'HomeController@editAccount')->name('editaccount');
Route::get('/account/post', 'HomeController@myPost')->name('mypost');
Route::delete('post/{id}', 'HomeController@postDelete')->name('deletemypost');
Route::get('/account/inbox', 'HomeController@inbox')->name('inbox');
/* 
========================================
---------     EVENTS PAGE    -----------
*/
// dektop
Route::get('/account/events/', 'HomeController@myEvents')->name('myEvents');
Route::post('add/new-event', 'HomeController@newEvent')->name('new.event');
Route::get('event/responses', 'HomeController@EventResponse')->name('event.response');
Route::delete('event/{id}', 'HomeController@destroyEvent')->name('event.destroy');
Route::get('events/{slug}', 'PageController@singleEvent')->name('singleEvent');
// mobile
Route::get('/m/add/event', 'HomeController@getNewEvenPage')->name('mobile-new-event-page');
Route::get('/account/m/events/', 'HomeController@mobileMyEvents')->name('mobile.myEvents');
Route::get('events/m/{slug}', 'PageController@mobileSingleEvent')->name('mobile.singleEvent');
// response
Route::post('/event/enrollNow', 'PageController@eventEnrollForm')->name('enrollNow');

/* 
=================================================
---------   USER PROFILE EDIT/AVATAR  -----------
*/
Route::get('/account/{username}', 'HomeController@myAccount')->name('myaccount');
Route::post('/avatar/edit', 'HomeController@avatar_update')->name('avatar.update');
Route::post('/profile/edit/{id}', 'HomeController@updateAccount')->name('profile.update');

/* 
========================================
---------     INBOX PAGE    -----------
*/
Route::post('/message', 'HomeController@sendMessage')->name('send-message');

Route::get('/contacts', 'HomeController@get');
Route::get('/conversation/{id}', 'HomeController@getMessageFor');
Route::post('/conversation/send', 'HomeController@send');

/* 
========================================
---------     COMMENTS PAGE    -----------
*/
Route::post('comment', 'CommentController@store')->name('comments.store');

/* 
========================================
---------------  POST  -----------------
*/
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function(){
    Route::post('create_post', 'PostController@createPost');
});

/* 
========================================
---------     COMMUNITY PAGE    -----------
*/
Route::get('/get_community', 'CommunityController@get_community');
Route::get('/all_community', 'CommunityController@all_community');
Route::get('/c/{slug}', 'CommunityController@single')->name('community');

/* 
========================================
------  POST ROUTE BY API - AXIOS ------
*/
Route::get('new/post', 'PostController@newPost')->middleware('auth');
Route::get('new/post/mobile', 'PostController@newMobilePost')->middleware('auth');
Route::get('get_all', 'PostController@getAllPosts');
Route::post('/images-upload', 'PostController@imageUpload');
Route::get('/p/{slug}', 'PostController@single')->name('singlePost');
Route::get('/m/{slug}', 'PostController@singleMobile')->name('singleMobile');
/* 
========================================
---------     PODCAST PAGE    -----------
*/
Route::get('new/podcast', 'PodcastController@newPodcast')->middleware('auth');
Route::post('new/podcast', 'PodcastController@createPodcast')->middleware('auth');
Route::get('api-podcasts', 'PodcastController@ApiPodcast');
Route::get('podcast/{id}', 'PodcastController@SinglePodcast');
Route::get('podcasts/{slug}', 'PodcastController@SinglePodcastDesktop');
Route::get('all/podcasts', 'PodcastController@getPodcast')->name('podcast');
Route::get('m/all/podcasts', 'PodcastController@getPodcastMobile')->name('podcast.mobile');

/* 
========================================
---------     LIKE ROUTES    -----------
*/
Route::post('favorite/{post}', 'PostController@favoritePost');
Route::post('unfavorite/{post}', 'PostController@unFavoritePost');
Route::get('my_favorites', 'UserController@myFavorites')->middleware('auth')->name('savedpost');

/* 
========================================
---------   PUBLIC PROFILE   -----------
*/
Route::get('user/{id}', 'PageController@profile')->name('public-profile');


View::composer(['*'], function($view){
    $user = Auth::user();
    $view->with('user', $user);
});

