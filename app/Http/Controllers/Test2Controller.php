<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Captcha;

class Test2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote']]);
    }

    public function index(Request $request)
    {
    	return captcha_img();
    	//return Captcha::create();
    	//return view('chen2');
    }
}