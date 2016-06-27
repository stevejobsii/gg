<?php

#------手机端articles---------------
Route::any('m/articles','MobleArticlesController@index');
#------weixin----------
Route::any('/weixin', 'WeixinController@serve');
Route::group(['middleware' => 'wechat.oauth'], function () {
    Route::get('/weixin/user','WeixinController@weixinuser');// 拿到接入授权用户资料 （非H5）
    Route::any('weixingame','WeixinController@weixingame');
    Route::get('/getimage','MaterialController@getimage'); //get materials
});
Route::get('/weixin/materials','MaterialController@materials');//获得media_id
Route::any('/weixin/staffs','WeixinController@staffs');//get 客服列表
Route::any('/weixin/mendian','WeixinController@mendian');//get 门店列表
Route::any('/weixin/broadcast','WeixinController@broadcast');//广播一月4次
//Route::any('/weixin/order','WeixinPaymentController@orderTest');//下单test
Route::any('/weixin/oauth','WeixinPaymentController@oauth');//授权h5
Route::any('/weixin/order','WeixinPaymentController@order');//回调
Route::any('/weixin/setattributes','WeixinPaymentController@SetAttributes');//set payment attributes
Route::any('/weixin/paymentnotify','WeixinPaymentController@paymentnotify');//支付结果通知
//Route::any('/weixin/staff')

#------geetest验证码---------
Route::resource('gt','GtController');
Route::any('mygtid','GtController@mygtid');
Route::any('gt1','GtController@gt1');
Route::any('gt2','GtController@gt2');
Route::post('/gt/{photo}/upvote', 
        ['as' => 'gt.upvote',
        'uses' => 'GtController@upvote'])->before('csrf');
#------蘑菇街验证码-------
Route::any('mgjyz','GtController@mgjyz');
Route::get('mgjimg','GtController@img');
Route::post('mgjcheck','GtController@mgjcheck');
#------h13.cn页面前端---------------
Route::resource('h13','h13Controller');
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
#------浩立微信-----------
Route::get('haoli/fzzl','HaoliController@fzzl');
Route::get('haoli/szqzl','HaoliController@szqzl');
Route::get('haoli/cljqc','HaoliController@cljqc');
Route::get('haoli/czlfl','HaoliController@czlfl');
# ------------------ test stuff ------------------------
Route::get('/home',function (){return redirect('/articles'); });
Route::get('/', function (){return redirect('/articles');
});
Route::resource('test','TestController');
Route::any('test1','TestController@test1');
Route::any('test2','TestController@test2');
