
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
Route::get('/', function (){return redirect('/articles');
});
Route::resource('test1','Test1Controller');
Route::resource('test','TestController');
Route::resource('test2','Test2Controller');
  Route::any('captcha-test', function()
    {
        if (Request::getMethod() == 'POST')
        {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
            {
                echo '<p style="color: #ff0000;">Incorrect!</p>';
            }
            else
            {
                echo '<p style="color: #00ff30;">Matched :)</p>';
            }
        }

        $form = '<form method="post" action="captcha-test">';
        $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        $form .= '<p>' . captcha_img() . '</p>';
        $form .= '<p><input type="text" name="captcha"></p>';
        $form .= '<p><button type="submit" name="check">Check</button></p>';
        $form .= '</form>';
        return $form;
    });
# ------------------ article stuff ------------------------
Route::resource('articles','ArticlesController');
Route::post('/articles/{photo}/upvote', 
        ['as' => 'articles.upvote',
        'uses' => 'ArticlesController@upvote'])->before('csrf');
# ------------------ tag stuff ------------------------
Route::get('tags/week/hot', 'TagsController@weekhot');
Route::get('tags/month/hot', 'TagsController@monthhot');
Route::get('tags/hot', 'TagsController@hot');
Route::get('tags/GIF', 'TagsController@GIF');
Route::resource('tags', 'TagsController');
# ------------------ register|login stuff ------------------------
Route::get('auth/qq','Auth\AuthController@qq');
Route::get('auth/weixin','Auth\AuthController@weixin');
Route::get('auth/weibo','Auth\AuthController@weibo');
//Route::get('auth/weixinweb','Auth\AuthController@weixinweb');
Route::get('auth/{provider}/callback', 'Auth\AuthController@callback');

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
//获取通知数
Route::get('/notifications/count', [
    'as' => 'notifications.count',
    'uses' => 'NotificationsController@count',
]);
//打开个人用户设置
Route::get('/settings', [
    'as' => 'users.settings',
    'uses' => 'UsersController@settings',
]);
//上传avatar
Route::post('/settings/update-avatar', [
    'as' => 'users.avatarupdate',
    'uses' => 'UsersController@avatarupdate',
]);
//上传修改秘密
Route::post('/settings/resetPassword',[
    'as' => 'users.resetPassword',
    'uses' => 'UsersController@resetPassword',
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
Route::delete('notifications/destroy', [
        'as' => 'notifications.destroy',
        'uses' => 'NotificationsController@destroy',
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
#  ------------------admin info stuff (建设中）------------------------
// Route::resource('info','InfoController');
// get('info', function() {
//     return view('guestbook/guestbook');
// });
// get('api/messages', function() {
//     return App\Article::all();
// });
// post('api/messages', function() {
//     return App\Article::create(Request::all());
// });
