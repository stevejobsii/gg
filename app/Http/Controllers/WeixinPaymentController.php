<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

class WeixinPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function order()
    {
        $wechat = app('wechat');
        $js = $wechat->js;
        $payment = $wechat->payment;
        $attributes = [
        'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
        'body'             => 'iPad mini 16G 白色',
        'detail'           => 'iPad mini 16G 白色',
        'out_trade_no'     => md5(uniqid().microtime()),
        'total_fee'        => 1,
        'notify_url'       => 'https://goodgoto.com/weixin/payment/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        // ...
        ];
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        return $result;
        return $result->return_code;
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }
        //return view('weixin.payment1',compact('order','js','payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
