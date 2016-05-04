<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\good\gt\lib\geetestlib;
use App\good\gt\config\config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article as Article;
use DB;
//use Intervention\Image\ImageManagerStatic as Image;

define("CAPTCHA_ID", "6ec021792ad83ec2c0743ec6bcbc1074");
define("PRIVATE_KEY", "54959c09c8d89670480d1cdbb4c8cb49");
class GtController extends Controller
{
    public $session_var = 'captcha';

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

    public function mgjyz()
    {
        session_start();
        header("Content-Type:image/jpeg", true);
        $str = array();// 储存4幅图片旋转的信息
        
        $imgs = array("mgj/1.jpg", "mgj/2.jpg", "mgj/3.jpg", "mgj/4.jpg");// 调用4幅图片
        
        $dests = imagecreatetruecolor(320,320);// 新建一幅320*320px的大图用来存放后面的16副小图（80*80px）
        for($i=0;$i<4;$i++){  // 循环1，处理"1.jpg", "2.jpg", "3.jpg", "4.jpg"
            $str[$i] = mt_rand(1,3); // 旋转角度 (1~3)* 90度，
            
            $GG = $str[$i];
            for($j=0;$j<4;$j++){ // 循环2，将每一幅图都转4次，这里是为了点击旋转图片
                $source = imagecreatefromjpeg($imgs[$i]);
                $angle = $GG > 0 ? $GG : 4;
                $angle = $GG * 90;
                $source = imagerotate($source, $angle, 0); // 图片旋转
                imagecopy($dests,$source,80*$i,80*$j,0,0,80,80); // 图片贴到320*320px的大图上去
                imagedestroy($source);  // 销毁图片信息
                $GG--;
            }
        };

        //$image = imagejpeg($dests);
        //return implode(",", $str);
        $_SESSION[$this->session_var] = implode(",", $str);  // 数组变成字符串，储存到SESSION
        //return $image;    // 将图片以流的形式输出
        $image = imagejpeg($dests);
    }
}
