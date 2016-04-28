<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Captcha;
use Intervention\Image\ImageManagerStatic as Image;

class Test2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote']]);
    }

    public function index(Request $request)
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