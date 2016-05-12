<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application as Application;
use EasyWeChat\Message\News;
use Wechat;
use EasyWeChat\Message\Material as Material;

class WeixinController extends Controller
{

    public function serve()
    {
        Log::info('request arrived.'); 
        $app = app('wechat');
        $userApi = $app->user;
        $material = $app->material;
        $server = $app->server;
        $server->setMessageHandler(function($message) use ($userApi,$app,$material){
            switch($message->MsgType){
                case'event':
                    if($message->Event=='subscribe'){
                        return '欢迎'.$userApi->get($message->FromUserName)->nickname.'关注广州市浩立生物科技有限公司！';
                    }
                    if($message->Event=='CLICK'){
                        switch($message->EventKey){
                            case'HYJCY': 
                                $news1 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJjEPvYyuYf-J0lmQfdtPh9g');
                                $app->staff->message($news1)->to($message->FromUserName)->send();
                                return  '还原基础油';
                                break;
                            case'GCHYSZ':
                                $news2 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJsM2CCr2SkQr9aruzNnPi_0');
                                $app->staff->message($news2)->to($message->FromUserName)->send(); 
                                return '高纯环氧树脂';
                                break;
                            case'GCDGZ': 
                                $news3 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJkH9Z9FFbYS-LclPDdaW8L8');
                                $app->staff->message($news3)->to($message->FromUserName)->send(); 
                                return '高纯单甘酯';
                                break;
                            case'SZQZL': 
                                $news4 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJn5D9r4bNx_eYw7C88VWqsk');
                                $app->staff->message($news4)->to($message->FromUserName)->send(); 
                                return '水蒸气蒸溜';
                                break;
                            case'SCYJZ': 
                                $news5 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJjJZiJucCYE_ohVHUOAs-PY');
                                $app->staff->message($news5)->to($message->FromUserName)->send(); 
                                return '山茶油精制';
                                break;
                            case'YYXJ': 
                                $news6 = new Material('mpnews', 't7A8ySU0kCuy2_K24EbgJiTUWGf1b9-A_Bn1Hby9hqs');
                                $app->staff->message($news6)->to($message->FromUserName)->send(); 
                                return '烟用香精';
                                break;
                            default:
                                break;
                        }
                    }
                break;
                case'text':
                    return new News([
                                    'title'       => '欢迎'.$userApi->get($message->FromUserName)->nickname.'访问广州市浩立生物科技有限公司！',
                                    'description' => '浩立与华南理工大学共同携手合作，专业分子蒸馏、水蒸气蒸馏、超临界CO2萃取、超重力场等高新提纯、分离技术研究开发。致力于：天然产物、香料、化工材料等研发与应用；分离提纯设备、化工及香料生产设备、香料及化工等设备设计制造。',
                                    'url'         => 'http://www.hao-li.net/',
                                    'image'       => 'http://www.hao-li.net/Upload/PicFiles/2011.9.11_15.5.41_8683.jpg',
                                    ]);
                break;
                default:
                    break;
            };    
        });//自动回复
        $menu = $app->menu;
        $buttons = [
            [   
                "name"       => "项目介绍",
                "sub_button" => [
                    [
                        "type" => "click",
                        "name" => "还原基础油",
                        "key"  => "HYJCY"
                    ],
                    [
                        "type" => "click",
                        "name" => "高纯环氧树脂",
                        "key"  => "GCHYSZ"
                    ],
                    [
                        "type" => "click",
                        "name" => "高纯单甘酯",
                        "key"  => "GCDGZ"
                    ],
                    // [
                    //     "type" => "click",
                    //     "name" => "山茶油精制",
                    //     "key"  => "SCYJZ"
                    // ],
                    // [
                    //     "type" => "click",
                    //     "name" => "水蒸气蒸溜",
                    //     "key"  => "SZQZL"
                    // ],
                    // [
                    //     "type" => "click",
                    //     "name" => "烟用香精",
                    //     "key"  => "YYXJ"
                    // ],
                ],
            ],
            [
                "name"       => "产品介绍",
                "sub_button" => [
                    [
                        "type" => "click",
                        "name" => "分子蒸馏",
                        "key"  => "FZZL"
                    ],
                    [
                        "type" => "click",
                        "name" => "水蒸气蒸馏",
                        "key"  => "SZQZL"
                    ],
                    [
                        "type" => "click",
                        "name" => "超临界萃取",
                        "key"  => "CLJQC"
                    ],
                    [  
                        "type" => "click",
                        "name" => "超重力分离",
                        "key"  => "CZLFL"
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
        $user = session('wechat.oauth_user');
        $openId = $user->getId(); // 拿到授权用户资料   
        
        $app = app('wechat');
        $userService = $app->user;
        $user = $userService->get($openId);
        dd($user->nickname);
    }

}
