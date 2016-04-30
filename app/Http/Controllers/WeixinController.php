<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class WeixinController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // $options = [
    // 'debug'  => true,
    // 'app_id' => 'wxe1288621d8386e3c',
    // 'secret' => '912527273869accea1d8cb794164f24f',
    // 'token'  => 'whatthefuck',
    // // 'aes_key' => null, // 可选
    // 'log' => [
    //     'level' => 'debug',
    //     'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
    // ],
    // //...
    // ];
    // $app = new Application($options);
    // // 将响应输出
    // $app->server->serve()->send();
    return 'whatthefuck';
    }


    public function weixingame(Request $request)
    {
        return view('weixingame');
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
