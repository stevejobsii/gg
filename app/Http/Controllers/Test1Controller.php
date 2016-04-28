<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;

class Test1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote']]);
    }

    public function index(Request $request)
    {
    	//return $request->ip();
    	return view('chen1');
    }
}