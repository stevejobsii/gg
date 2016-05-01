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
        
        // $menu = $wechat->menu;
        // $buttons = [
        //     [
        //         "type" => "click",
        //         "name" => "今日歌曲",
        //         "key"  => "V1001_TODAY_MUSIC"
        //     ],
        //     [
        //         "name"       => "菜单",
        //         "sub_button" => [
        //             [
        //                 "type" => "view",
        //                 "name" => "搜索",
        //                 "url"  => "http://www.soso.com/"
        //             ],
        //             [
        //                 "type" => "view",
        //                 "name" => "视频",
        //                 "url"  => "http://v.qq.com/"
        //             ],
        //         ],
        //     ],
        // ];
        // $menu->add($buttons);
        Log::info('return response.');
        return $wechat->server->serve();
    }

    public function demo1()
    {
        $app = new Application($options);

        $userService = $app->user;

        $user = $userService->get($openId);

        echo $user->nickname; 

    }

    public function weixingame(Request $request)
    {
        return view('weixingame');
    }
}
