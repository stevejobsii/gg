<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\good\gt\lib\geetestlib;
use App\good\gt\config\config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article as Article;
use DB;

define("CAPTCHA_ID", "6ec021792ad83ec2c0743ec6bcbc1074");
define("PRIVATE_KEY", "54959c09c8d89670480d1cdbb4c8cb49");
class GtController extends Controller
{

    public function index()
    {
        $articles = DB::table('articles')->simplepaginate(3);
         //return view('gt',compact('articles'));
        return view('geet',compact('articles'));
    }

    public function mygtid()
    {
        $articles = DB::table('articles')->simplepaginate(3);
        return view('gt',compact('articles'));
    }

    
    public function gt1()
    {
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        session_start();
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;

        echo  $GtSdk->get_response_str();
    }

    public function gt2(Request $request)
    {  
        session_start();
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($request->geetest_challenge, $request->geetest_validate, $request->geetest_seccode, $user_id);
            if ($result) {
                echo 'Yes!';
            } else{
                echo 'No';
            }
        }else{
            if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                echo "yes";
            }else{
                echo "no";
            }
        }
    }

    public function upvote($photo,Request $request)
    {
                    $article = \App\Article::where('photo', $photo)->firstOrFail();
                    if ($article->votes()->ByWhom($request->ip())->count()) {
                    $article->votes()->ByWhom($request->ip())->delete();
                    $article->decrement('vote_count', 1);
                    } else {
                    $article->votes()->create(['user_id' => $request->ip()]);
                    $article->increment('vote_count', 1);
                    }
                    return $article->vote_count;       
    }
}
