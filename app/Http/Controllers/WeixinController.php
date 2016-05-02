<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Wechat;

class WeixinController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); 
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎访问兔朱迪的窝！"; 
        });
        Log::info('return response.');
        return $wechat->server->serve();
    }

    public function weixingame()
    {
        $wechat = app('wechat');
        $js = $wechat->js;
        return view('weixingame',compact('js'));
    }

    public function jssdk()
    {
        $wechat = app('wechat');
        $js = $wechat->js;




    }

    public function demo1()
    {
        $app = new Application($options);

        $userService = $app->user;

        $user = $userService->get($openId);

        echo $user->nickname; 

    }
}
