<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

class TestController extends Controller
{
	$options = [
    'debug'     => true,
    'app_id'    => 'wxe1288621d8386e3c',
    'secret'    => 'f1c242f4f28f735d4687abb469072a29',
    'token'     => 'easywechat',
    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/easywechat.log',
    ],
    // ...
	];

	$app = new Application($options);

	$server = $app->server;
	$user = $app->user;

	$server->setMessageHandler(function($message) use ($user) {
	    $fromUser = $user->get($message->FromUserName);

	    return "{$fromUser->nickname} 您好！欢迎关注 overtrue!";
	});

	$server->serve()->send(); 

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote','weixingame']]);
    }

    public function index(Request $request)
    {
    	return view('chen');
    }

    public function weixingame(Request $request)
    {
    	return view('weixingame');
    }

}