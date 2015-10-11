<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as urlRequest;
use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag, urlRequest $request)
    {
        //query within tag
        if ($search = $request->query('q')) {
            $articles = $tag->articles()->search($search)->orderBy('created_at', 'desc')->simplepaginate(30);
        } elseif ($search = $request->query('id')) {
            $articles = $tag->articles()->where('id', '<', $search)->orderBy('created_at', 'desc')->simplepaginate(30);

        } else {
            //获取这个tag的articles并用articles.index反应
        $articles = $tag->articles()->orderBy('created_at', 'desc')->simplepaginate(30);
        }
        $articles->setPath($tag->name);
        return view('articles.index', compact('articles', 'search'));
    }
}
