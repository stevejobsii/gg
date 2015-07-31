<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller {


	public function __construct(){
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}


	public function index()
	{

		$articles = \App\Article::latest()->published()->get();

		return view('articles.index',compact('articles'));
	}

	public function show(\App\Article $article)
	{
		
		return view('articles.show',compact('article'));
	}

	public function create()
	{
		$tags = \App\Tag::lists('name', 'id');
		
		return view('articles.create', compact('tags'));
	}

	/**
	 * [store description]
	 * @param  ArticleRequest
	 * @return [type]
	 */
	public function store(ArticleRequest $request)
	{
	  
        $this->createArticle($request);
 
		return redirect('articles')->with([
                'flash_message' => 'good job!你的文章成功创建！',
                'flash_message_important' => true
			]);
	}


	public function edit(\App\Article $article)
	{
        $tags = \App\Tag::lists('name', 'id');
		return view('articles.edit', compact('article', 'tags'));
	}


	public function update(\App\Article $article, ArticleRequest $request)
	{

		$article->update($request->all());

		$this->syncTags($article, $request->input('tag_list'));

		return redirect('articles');
	}
    	/**
	 * Sync up the list of tags in the database
	 *
	 * @param  Article $article
	 * @param  array   $tags
	 */
	private function syncTags(\App\Article $article, array $tags)
	{
		$article->tags()->sync($tags);
	}

	/**
	 * Save a new article
	 * @param  ArticleRequest $request
	 * @return mixed
	 */
	private function createArticle(ArticleRequest $request)
	{
 

		$article = Auth::user()->articles()->create($request->all());

		$this->syncTags($article, $request->input('tag_list', []));
        
        //获取收到“image”并存储
		$imageName = $article->id . '.' . 
        $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(
        base_path() . '/public/images/catalog/', $imageName
    );  
        Image::make(base_path() . '/public/images/catalog/' . $imageName)
        ->resize(420, null, function ($constraint) {$constraint->aspectRatio();})
        ->insert(base_path() . '/public/images/catalog/watermark.jpg', 'right')
        ->save(base_path() . '/public/images/catalog/' . $imageName);
        
        //保存存储名字和extension
        $article->photo = $imageName;
        $article->save();
		return $article;
	}

        public function upvote($id)
        {
        $article = \App\Article::find($id);
        //App::make('good\Vote\Voter')->articleUpVote($article);
        return view('articles');
        }

        public function downvote(\App\Article $article)
        {
        //$article = \App\Article::find($id);
        App::make('good\Vote\Voter')->articleDownVote($article);
        return view('articles.show',compact('article'));
        }

}