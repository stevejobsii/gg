<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tag;

class TagsController extends Controller {

	public function show(Tag $tag)
	{
		//获取这个tag的articles并用articles.index反应
		$articles = $tag->articles()->latest()->published()->paginate(10);

		return view('articles.index', compact('articles'));
	}

}
