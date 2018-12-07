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
Route::get('/loader', function () {
    return view('loader');
});
Route::get('/', function () {
	$posts = DB::table('posts')->get();
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){

// adding friends
Route::get('/findFriends', 'ProfileController@findFriends');
Route::get('/addFriend/{id}','ProfileController@sendRequest');
Route::get('/requests', 'ProfileController@requests');
Route::get('/accept/{firstname}/{id}','ProfileController@accept');
Route::get('/friends', 'ProfileController@friends');
Route::get('/requestRemove/{id}','ProfileController@requestRemove');
Route::get('/profile/allFriends', 'ProfileController@allFriends');
// end of adding friends
Route::get('/unfriend/{id}', function($id){
	$loggedUser = Auth::user()->id;
	DB::table('friendships')
	->where('requestor', $loggedUser)
	->where('user_requested', $id)
	->delete();
	return view('profile.friends')->with('msg', 'You just unfriend '.$id);
});

// edit your profile
Route::get('/profile/{username}/editProfile','ProfileController@editProfile');
Route::patch('/profile/{username}/editProfile','ProfileController@updateProfile');
// end of edit profile

Route::get('/profile/{username}', 'ProfileController@profileFriends');
Route::get('/profile/{username}', 'ProfileController@profile');
Route::post('/profile-image', 'ProfileController@update_avatar');

Route::resource('posts', 'PostsController');
Route::resource('profile', 'PostsController');
Route::resource('home', 'PostsController');


Route::post('/like', 'PostsController@likePost')->name('like');
Route::get('/profile/{username}', 'ProfileController@feed');
Route::get('/profile/{username}/home', 'HomeController@homeFeed');

Route::post('/comment', 'CommentController@index');

});












