
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
Route::get('/articles/{id}/upvote', 
    	['as' => 'articles.upvote','uses' => 
    	'ArticlesController@upvote'])->before('csrf');
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);




# ------------------ User stuff ------------------------
Route::resource('users','UsersController');
Route::get('/users/{id}/articles', [
    'as' => 'users.articles',
    'uses' => 'UsersController@articles',
]);
Route::get('/users/{id}/replies', [
    'as' => 'users.replies',
    'uses' => 'UsersController@replies',
]);
Route::get('/users/{id}/upvotes', [
    'as' => 'users.upvotes',
    'uses' => 'UsersController@upvotes',
]);


# ------------------ delete stuff ------------------------
Route::delete('articles/{id}/destroy',  [
        'as' => 'articles.destroy',
        'uses' => 'ArticlesController@destroy',
]);





// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
