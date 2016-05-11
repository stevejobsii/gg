<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application as Application;
use EasyWeChat\Message\News;
use Wechat;
use Session;

class WeixinController extends Controller
{

    public function serve()
    {
        Log::info('request arrived.'); 
        $app = app('wechat');
        $server = $app->server;
        $server->setMessageHandler(function($message){
            return new News([
                            'title'       => '欢迎访问广州市浩立生物科技有限公司！',
                            'description' => '浩立与华南理工大学共同携手合作，专业分子蒸馏、水蒸气蒸馏、超临界CO2萃取、超重力场等高新提纯、分离技术研究开发。致力于：天然产物、香料、化工材料等研发与应用；分离提纯设备、化工及香料生产设备、香料及化工等设备设计制造。',
                            'url'         => 'http://www.hao-li.net/',
                            'image'       => 'http://www.hao-li.net/Upload/PicFiles/2011.9.11_15.5.41_8683.jpg',
                            ]);
        });//自动回复
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "view",
                "name" => "浩立主页",
                "url"  => "http://www.hao-li.net/"
            ],
            [
                "name"       => "产品介绍",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "分子蒸馏",
                        "url"  => "https://goodgoto.com/haoli/fzzl"
                    ],
                    [
                        "type" => "view",
                        "name" => "水蒸气蒸馏",
                        "url"  => "https://goodgoto.com/haoli/szqzl"
                    ],
                    [
                        "type" => "view",
                        "name" => "超临界萃取",
                        "url"  => "https://goodgoto.com/haoli/cljqc"
                    ],
                    [
                        "type" => "view",
                        "name" => "超重力分离",
                        "url"  => "https://goodgoto.com/weixin/user"
                    ],
                ],
            ],
        ];//菜单
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

    public function weixinuser()
    {
        $app = app('wechat');
        $userService = $app->user;
        $user = session('wechat.oauth_user'); // 拿到授权用户资料   
        $user = $userService->get($user->getId());
        dd($user->getNickname());
    }

    // public function demo1()
    // {
    //     $app = new Application($options);
    //     $userService = $app->user;
    //     $user = $userService->get($openId);
    //     echo $user->nickname; 
    // }
}
