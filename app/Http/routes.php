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
Route::get('/home',function (){return redirect('/articles'); });
Route::get('about','PageController@about');
Route::get('contact','PageController@contact');
Route::get('/', function () {
    return view('welcome');
});
Route::resource('articles','ArticlesController');
Route::get('tags/{tags}', 'TagsController@show');
Route::controllers([
			'auth'=>'Auth\AuthController',
			'password'=>'Auth\PasswordController'
		]);


    Route::get('/articles/{id}/upvote', 
    	['as' => 'articles.upvote','uses' => 
    	'ArticlesController@upvote'
     ]);




