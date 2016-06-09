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
    public function order()//下单
    {
        Log::info('request arrived.'); 
        $app = app('wechat');
        $js = $app->js;
        $payment = $app->payment;
        $attributes = [
        'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
        'body'             => '玫瑰精油一瓶',
        'detail'           => '玫瑰精油一瓶',
        'out_trade_no'     => md5(uniqid().microtime()),
        'total_fee'        => 1,
        'notify_url'       => 'https://goodgoto.com/weixin/payment/notify', 
        'openid'           => Auth::user()->name,
        // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        ];
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }
        $config = $payment->configForJSSDKPayment($prepayId);
        return $config;
        //return view('weixin.payment1',compact('order','js','payment'));
        Log::info('return response.');
    }

    public function oauth()//网站微信授权
    {
        $app = app('wechat');
        return $response = $app->oauth->scopes(['snsapi_userinfo'])
                          ->redirect();
    }
    
    public function callback()//回调创建用户（email指的是nickname）
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
        return redirect('weixin/order');
        //return $user->toArray();
    }    
}
