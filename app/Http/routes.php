
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
# ------------------ test stuff ------------------------
Route::get('/home',function (){return redirect('/articles'); });
Route::get('about','PageController@about');
Route::get('contact','PageController@contact');
Route::get('/', function (){return redirect('/articles');
});
Route::get('/test', function (){if (mt_rand(0, 1) === 0) {$zuoyou = 'right';}else{$zuoyou = 'left';};return $zuoyou;
});
# ------------------ article stuff ------------------------
Route::resource('articles','ArticlesController');
Route::post('/articles/{id}/upvote', 
        ['as' => 'articles.upvote',
        'uses' => 'ArticlesController@upvote'])->before('csrf');
# ------------------ tag stuff ------------------------
Route::get('tags/{tags}', 'TagsController@show');
# ------------------ register|login stuff ------------------------
Route::controllers([
			'auth'=>'Auth\AuthController',
			'password'=>'Auth\PasswordController'
		]);
# ------------------ Reply stuff ------------------------
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);
Route::post('/replies/{id}/upvote', 
        ['as' => 'replies.upvote',
        'uses' => 'RepliesController@upvote'])->before('csrf');
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
//通知中心
Route::get('/notifications', [
    'as' => 'notifications.index',
    'uses' => 'NotificationsController@index',
]);
//通知数
Route::get('/notifications/count', [
    'as' => 'notifications.count',
    'uses' => 'NotificationsController@count',
]);
# ------------------ delete stuff ------------------------
Route::delete('articles/{photo}/destroy',  [
        'as' => 'articles.destroy',
        'uses' => 'ArticlesController@destroy',
]);
Route::delete('replies/{id}/destroy',  [
        'as' => 'replies.destroy',
        'uses' => 'RepliesController@destroy',
]);
# ------------------ bookmark stuff ------------------------
post('api/bookmark', function() {
         Auth::user()->bookmark = Request::get('bookmark');
         Auth::user()->save();
});
get('api/bookmark', function(){
    return Auth::user()->bookmark;
});
# ------------------ guestbook stuff ------------------------
use App\Message;
get('guestbook', function() {
    return view('guestbook/guestbook');
});
// API
get('api/messages', function() {
    return App\Message::all();
});
post('api/messages', function() {
    return App\Message::create(Request::all());
});
# ------------------ Password reset stuff ------------------------
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
