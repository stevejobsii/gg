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
    	return view('chen');
    }

    public function weixingame(Request $request)
    {
    	return view('weixingame');
    }

}