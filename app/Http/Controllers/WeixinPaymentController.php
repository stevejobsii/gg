<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;
use Log;
use App\User;
use Auth;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;

class WeixinPaymentController extends Controller
{
    public function SetAttributes (Request $request)
    {
        switch($request->body){
            case'roseoil': 
                $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '玫瑰精油一瓶',
                'detail'           => '玫瑰精油一瓶',
                'out_trade_no'     => md5(uniqid().microtime()),
                'total_fee'        => 1,
                'notify_url'       => 'https://goodgoto.com/weixin/paymentnotify', 
                'openid'           => Auth::user()->name,
                ];
                break;
            case'csoil':
                $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '山苍子精油一瓶',
                'detail'           => '山苍子精油一瓶',
                'out_trade_no'     => md5(uniqid().microtime()),
                'total_fee'        => 2,
                'notify_url'       => 'https://goodgoto.com/weixin/paymentnotify', 
                'openid'           => Auth::user()->name,
                ]; 
                break;
            case'xcoil': 
                $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '沉香精油一瓶',
                'detail'           => '沉香精油一瓶',
                'out_trade_no'     => md5(uniqid().microtime()),
                'total_fee'        => 3,
                'notify_url'       => 'https://goodgoto.com/weixin/paymentnotify', 
                'openid'           => Auth::user()->name,
                ]; 
                break;
        }   

        $payment = $app->payment;

        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }

        $json = $payment->configForPayment($prepayId);
        return $json;
    }

    public function oauth()//网站微信授权
    {
        $app = app('wechat');
        return $response = $app->oauth->scopes(['snsapi_userinfo'])
                           ->redirect();
    }
    
    public function order()//回调并创建用户（email指的是nickname）
    {
        Log::info('request(callback) arrived.'); 
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

        return view('weixin.payment1');
        Log::info('return(callback) response.');
    }  

    public function paymentnotify()
    {
        
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            //$order = 查询订单($notify->transaction_id);
            //return 'sfs';
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->paid_at) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 'paid';
            } else { // 用户支付失败
                $order->status = 'paid_fail';
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });
    }  

    public function orderTest()//下单
    {
        Log::info('request arrived.'); 
        //回调并创建用户
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

        //创建订单
        $payment = $app->payment;
        $attributes = [
        'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
        'body'             => '玫瑰精油一瓶',
        'detail'           => '玫瑰精油一瓶',
        'out_trade_no'     => md5(uniqid().microtime()),
        'total_fee'        => 1,
        'notify_url'       => 'https://goodgoto.com/weixin/paymentnotify', 
        'openid'           => Auth::user()->name,
        // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        ];
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }

        $json = $payment->configForPayment($prepayId);
        return view('weixin.payment1',compact('json','order'));
        Log::info('return response.');
    }
}
