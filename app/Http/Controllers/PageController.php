<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

	public function about()
	{
		$title = '<h1>About Page</h1>';
		return view('pages.about')->with('title',$title);
	}

	public function contact()
	{
		$title = '<h1>Contact Page</h1>';

		$contacts = [
			'Thom Yorke',
			'Phil Selway',
			'Ed O Brien'
		];

		//$contacts = [];

		return view('pages.contact', compact('title','contacts'));
	}
}
