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

Route::get('/', function () {
    return view('welcome');
})->name('welcomeRoute');

Route::post('/signup', [
	'uses' 	=>	'UserController@postSignup',
	'as' 		=> 	'signupRoute'
]);

Route::get('/dashboard', [
	'uses'	=> 'PostController@getDashboard',
	'as' 		=>	'dashboardRoute',
	'middleware' => ['auth']
]);

Route::post('/signin', [
	'uses' => 'UserController@postSignIn',
	'as' => 'signinRoute'
]);

Route::post('/createpost', [
	'uses'	=> 'PostController@postCreatePost',
	'as'	=>	'createPostRoute'
]);

Route::get('/deletepost/{post_id}', [
	'uses' => 'PostController@getDeletePost',
	'as' => 'deletePostRoute'
]);

Route::get('/logout', [
	'uses' => 'UserController@getLogout',
	'as' =>	'logoutRoute'
]);

Route::get('/getuser/{user_id}', [
	'uses' => 'UserController@getUserById',
	'as' => 'getUserRoute'
]);

Route::post('/editpost', [
	'uses' => 'PostController@editPostById',
	'as' => 'editPostRoute'
]);

Route::post('/editprofile', [
	'uses' => 'UserController@editProfile',
	'as' => 'updateProfileRoute'
]);

Route::get('/userimage/${foldername}/{filename}', [
	'uses' => 'UserController@getUserImage',
	'as' => 'profileImageRoute'
]);

Route::post('/likepost', [
  'uses' => 'PostController@postLikePost',
  'as' => 'likePostRoute'

]);

// Route::post('/editpost', function(\Illuminate\Http\Request $req){
// 	return response()->json([ 'post_body' => $req['body'], 'post_id' => $req['post_id'] ]);
// })->name('editPostRoute');
