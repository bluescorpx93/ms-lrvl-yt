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
	'uses'	=> 'UserController@getDashboard',
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
