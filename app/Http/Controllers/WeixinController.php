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
        $userService = app('wechat')->user;
        $user = $userService->get($openId);
        $server = app('wechat')->server;
        $server->setMessageHandler(function($message){
            return "欢迎"+$user->nickname+"访问广州市浩立生物科技有限公司！"; 
        });
        
        $menu = app('wechat')->menu;
        $buttons = [
            [
                "type" => "view",
                "name" => "浩立主页",
                "url"  => "http://www.hao-li.net/"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);

        Log::info('return response.');
        return $server->serve();
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
