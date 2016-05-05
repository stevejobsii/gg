<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use Wechat;

class WeixinController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); 
        $server = app('wechat')->server;
        $server->setMessageHandler(function($message){
            return new News([
                            'title'       => '欢迎访问广州市浩立生物科技有限公司！',
                            'description' => '广州市浩立生物科技有限公司是一家与华南理工大学共同携手合作，专业从事分子蒸馏、水蒸气蒸馏、超临界CO2萃取、超重力场等高新提纯、分离技术研究开发的高科技企业，我们致力于：天然产物、香料、化工材料等技术的研发与应用，以及分离提纯设备、化工及香料生产设备、化工仪表仪器、香料及化工等相关设备的设计制造。',
                            'url'         => 'http://www.hao-li.net/',
                            'image'       => 'http://www.hao-li.net/images/p1.jpg',
    ]););
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
