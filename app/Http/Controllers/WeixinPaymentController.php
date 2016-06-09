<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;
use Log;
use App\User;
use Auth;

class WeixinPaymentController extends Controller
{
    public function order()
    {
        Log::info('request arrived.'); 
        $app = app('wechat');
        $js = $app->js;
        $payment = $app->payment;
        // $server = $app->server;
        // $server->setMessageHandler(function($message){
        //     //return $message->FromUserName;
        //     return $message;
        // });
        $attributes = [
        'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
        'body'             => 'iPad mini 16G 白色',
        'detail'           => 'iPad mini 16G 白色',
        'out_trade_no'     => md5(uniqid().microtime()),
        'total_fee'        => 1,
        'notify_url'       => 'https://goodgoto.com/weixin/payment/notify', 
        // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        // ...
        ];
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        return $result;
        return $result->return_code;
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }
        Log::info('return response.');
        //return view('weixin.payment1',compact('order','js','payment'));
    }

    public function oauth()
    {
        $app = app('wechat');
        return $response = $app->oauth->scopes(['snsapi_userinfo'])
                          ->redirect();
    }
    
    public function callback()
    {
        $app = app('wechat');
        $oauthuser = $app->oauth->user();
        if (is_null($user = User::where('name', '=', $oauthuser->getId())->first())){
        $user = User::create([
            'name' => $oauthuser->getId(),
            'email'=> $oauthuser->getNickname(),
            'avatar'=>$oauthuser->getAvatar(),
        ]);
        }
        Auth::login($user,true);
        return $user->toArray();
    }    
}
