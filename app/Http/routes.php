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
Route::get('/', function (){return redirect('/articles');
});
Route::resource('articles','ArticlesController');
Route::get('tags/{tags}', 'TagsController@show');
Route::controllers([
			'auth'=>'Auth\AuthController',
			'password'=>'Auth\PasswordController'
		]);
Route::get('123', function() 
{
    
   Mail::send('emails.password',[],function($message)
   {
    $message->to('stevejobsii@163.com')->subject('12sdfsfd3');
   });
});

get('/articles/{id}/upvote', 
    	['as' => 'articles.upvote','uses' => 
    	'ArticlesController@upvote'
     ]);
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);


Route::post('upvotes',['as'=>'upvotes.store', function()
{ 
    Auth::user()->upvotes()->attach(Input::get('article-id'));
    return Redirect::back();
}]);

# ------------------ User stuff ------------------------
Route::resource('users','UsersController');









// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
