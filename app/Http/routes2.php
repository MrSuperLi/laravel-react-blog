<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'editor','namespace'=>'Admin','middleware'=>'auth'],function(){
	Route::get('/','UEditorController@index');
});

//登录了，则跳转到home
//Route::get('/', ['uses'=>'HomeController@index','middleware'=>'guest']);
Route::get('/', 'HomeController@index');

Route::get('articles/{id}', 'HomeController@show')->where('id',"[0-9]+");
Route::post('comments/publish', 'HomeController@store');

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');
Route::get('auth/logout','Auth\AuthController@getLogout');
/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
Route::controller('password','Auth\PasswordController');
//'middleware'=>'auth.basic'//HTTP认证
Route::group(['prefix'=>'home','namespace'=>'Admin','middleware' => 'auth'],function(){
	Route::get('/','ArticlesController@index');
	Route::resource('articles','ArticlesController');
	Route::resource('comments','CommentsController');
});
