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
Route::post('123', function() {
    return 123;
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

