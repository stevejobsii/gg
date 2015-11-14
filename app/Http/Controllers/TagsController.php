<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as urlRequest;
use App\Tag;
use DB;
use Request;


class TagsController extends Controller
{
    public function show(Tag $tag, urlRequest $request)
    {
        //query within tag
        if ($search = $request->query('q')) {
            $articles = $tag->articles()->search($search)->orderBy('created_at', 'desc')->simplepaginate(18);
        } elseif ($search = $request->query('id')) {
            $articles = $tag->articles()->where('id', '<', $search)->orderBy('created_at', 'desc')->simplepaginate(18);

        } else {
            //获取这个tag的articles并用articles.index反应
        $articles = $tag->articles()->orderBy('created_at', 'desc')->simplepaginate(18);
        }
        $articles->setPath($tag->name);
        //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(10)->get();
        //return $hotimgs;
        $hotreplies = \App\Reply::orderBy('vote_count', 'desc')->limit(10)->get();
        return view('articles.index', compact('articles', 'search','hotimgs','hotreplies'));
    }

    public function hot(urlRequest $request)
    {
        //query index 过滤'.mp4'
        if ($search = $request->query('q')) {
            $articles = \App\Article::search($search)->orderBy('vote_count', 'desc')->simplepaginate(30);
        } elseif ($search = $request->query('id')) {
            $search = \App\Article::where('photo', $search)->firstOrFail()->id;
            $articles = DB::table('articles')->where('id', '<=', $search)->orderBy('vote_count', 'desc')->simplepaginate(30);
            $search = $request->query('id');
        } else {
            $articles = DB::table('articles')->orderBy('vote_count', 'desc')->simplepaginate(30);
        }
        $articles->setPath('hot');
               //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(5)->get();
        //return $hotimgs;
        $hotreplies = \App\Reply::orderBy('vote_count', 'desc')->limit(5)->get();
        return view('articles.index', compact('articles', 'search','hotimgs','hotreplies'));
    }


    public function GIF(urlRequest $request)
    {
        //query index 过滤'.mp4'
        if ($search = $request->query('q')) {
            $articles = \App\Article::search($search)->where('type','.mp4')->orderBy('created_at', 'desc')->simplepaginate(30);
        } elseif ($search = $request->query('id')) {
            $search = \App\Article::where('photo', $search)->firstOrFail()->id;
            $articles = DB::table('articles')->where('type','.mp4')->where('id', '<=', $search)->orderBy('created_at', 'desc')->simplepaginate(30);
            $search = $request->query('id');
        } else {
            $articles = DB::table('articles')->where('type','.mp4')->orderBy('created_at', 'desc')->simplepaginate(30);
        }
        $articles->setPath('GIF');
               //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(5)->get();
        //return $hotimgs;
        $hotreplies = \App\Reply::orderBy('vote_count', 'desc')->limit(5)->get();
        return view('articles.index', compact('articles', 'search','hotimgs','hotreplies'));
    }
        
    public function create()
    {
        $author_id = '1';
        $this->authorOrAdminPermissioinRequire($author_id);
        return view('tags.create');
    }

    public function store()
    {
        $tag = \App\Tag::create(Request::all());
        return redirect('articles');
    }

    public function edit(\App\Tag $tag)
    {
        //权限/tags/China/edit
        $author_id = '1';
        $this->authorOrAdminPermissioinRequire($author_id);
        return view('tags.edit', compact('tag'));
    }
    
    public function update(\App\Tag $tag)
    {
        //修改标签
        $tag->update(Request::all());
        return redirect('articles');
    }

}

