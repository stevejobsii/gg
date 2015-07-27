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
Route::get('/1', function ()    {
    return view('g', ['name' => 'James']);
});

Route::get('about','PageController@about');
Route::get('contact','PageController@contact');
Route::get('/', function () {
    return view('welcome');
});
Route::resource('articles','ArticlesController');

Route::controllers([
			'auth'=>'Auth\AuthController',
			'password'=>'Auth\PasswordController'
		]);