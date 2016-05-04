<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote','weixingame']]);
    }

    public function index(Request $request)
    {
    	return view('vendor.chen');
    }

    public function test1(Request $request)
    {
    	return view('vendor.chen1');
    }

    public function test2(Request $request)
    {
	    $img = Image::canvas(800, 600, '#ff0000');
	    // create response and add encoded image data
	    $img->save(base_path() . '/public/dggggdd'  . '.jpg');
	    // set content-type
	    // $response->header('Content-Type', 'image/png');
	    // output
	    return $img->response('png');
	    //return captcha()->save('dd');
	    //return captcha_img();
		//return Captcha::create();
		//return view('chen2');
    }

}