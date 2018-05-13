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

/*Route::group(['prefix'=>'test'],function(){
	Route::get('se','WelcomeController@session');
	Route::get('getse','WelcomeController@getsession');
	//Route::get('/','WelcomeController@index');
	//Route::get('form','WelcomeController@form');
	//Route::get('editor',function(){return view('test.ueditor');});
	//Route::get('/{method}','WelcomeController@error')->where('method',"[a-zA-Z]+");
});*/

//ueditor
Route::group(['prefix'=>'editor','namespace'=>'Admin','middleware'=>'auth'],function(){
	Route::get('/','UEditorController@index');
	Route::post('/','UEditorController@index');
});

//Route::get('/', ['uses'=>'HomeController@index','middleware'=>'guest']);
Route::group(['prefix'=>'/','middleware'=>'csrf'],function(){
    Route::get('/', 'HomeController@index');
    Route::get('articles/{id}', 'HomeController@show')->where('id',"[0-9]+");
    Route::post('comments/publish', 'HomeController@store');
});

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');
Route::get('auth/logout','Auth\AuthController@getLogout');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::controller('password','Auth\PasswordController');
//'middleware'=>'auth.basic'//HTTP认证
Route::group(['prefix'=>'home','namespace'=>'Admin','middleware' => 'auth'],function(){
	Route::get('/','ArticlesController@index');
	Route::resource('articles','ArticlesController');
	Route::resource('comments','CommentsController');
	Route::resource('upload', 'UploadController');
});

Route::controller('check','React\AuthController');
Route::group(['prefix'=>'react','namespace'=>'React','middleware'=>'auth'],function(){
	Route::post('articles','ArticlesController@store');
	Route::resource('articles','ArticlesController');
});
