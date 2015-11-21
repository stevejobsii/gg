<?php namespace App\Http\Controllers;

use App\Article;
use App\Vote;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use File;
use Notification;
use Carbon\Carbon;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleEditRequest;
use Illuminate\Http\Request as urlRequest;

class ArticlesController extends Controller
{
    //登陆前只能看index和show
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','upvote']]);
    }


    public function index(urlRequest $request)
    {
        //query
        if ($search = $request->query('q')) {
            $articles = Article::search($search)->orderBy('created_at', 'desc')->simplepaginate(18);
        } elseif ($search = $request->query('id')) {
            //查找伪id（photo）
            $search = \App\Article::where('photo', $search)->firstOrFail()->id;
            $articles = DB::table('articles')->where('id', '<=', $search)->orderBy('created_at', 'desc')->simplepaginate(18);
            //伪搜索结果
            $search = $request->query('id');
        } else {
            //DB::代替Article::
            $articles = DB::table('articles')->orderBy('created_at', 'desc')->simplepaginate(18);
        }
        //已经点赞{!!$articles->appends(Request::except('page'))->render()!!}
        //$f = DB::table('votes')->whereuser_id(Auth::user()->id)->lists('votable_id');
        //http://example.com/custom/url?page=N, you should pass custom/url to the setPath
        $articles->setPath('articles');
        //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(5)->get();
        //return $hotimgs;
        $hotreplies = \App\Reply::orderBy('vote_count', 'desc')->limit(5)->get();
        return view('articles.index', compact('articles', 'search' ,'hotimgs','hotreplies'));
    }
    

    public function show(\App\Article $article)
    {
        $article->increment('view_count', 1);
        if($article->id == DB::table('articles')->first()->id){$previous = $article->photo;}
        else{$previous = \App\Article::where('id', '<', $article->id)->orderBy('id','desc')->firstOrFail()->photo;};
        if($article->id == DB::table('articles')->orderBy('id','desc')->first()->id){$next = $article->photo;}
        else{$next = \App\Article::where('id', '>', $article->id)->orderBy('id','asc')->firstOrFail()->photo;};
        return view('articles.show', compact('article','previous','next'));
    }

    public function create()
    {
        //get tags list
        $tags = \App\Tag::lists('cname', 'id');
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
        flash()->success('GOOD JOB!', '图片成功发布');
        return redirect('articles');
    }

    
    public function edit(\App\Article $article)
    {
        //权限
        $this->authorOrAdminPermissioinRequire($article->user_id);
        $tags = \App\Tag::lists('cname', 'id');
        return view('articles.edit', compact('article', 'tags'));
    }


    public function update(\App\Article $article, ArticleEditRequest $request)
    {
        //只能修改标题标签
        $article->update($request->all());
        $this->syncTags($article, $request->input('tag_list', []));
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
    
    public function destroy($photo)
    {
        $article = \App\Article::where('photo', $photo)->firstOrFail();
        //权限
        $this->authorOrAdminPermissioinRequire($article->user_id);
        //delete photo
        File::delete(base_path() . '/public/images/catalog/' . $article->photo . $article->type);
        if($article->type = '_long.jpg'){
            File::delete(base_path() . '/public/images/catalog/' . $article->photo . '.jpg');
        }
        \App\Article::destroy($article->id);
        return redirect('articles');
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
        // $type = $request->file('image')->getClientOriginalExtension();
        //$imageName = ($article->id) . '.' . $request->file('image')->getClientOriginalExtension();
        $length = 6;
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        if (mt_rand(0, 1) === 0) {$zuoyou = 'right';}else{$zuoyou = 'left';};
        //判断是非mp4，Image不支持mp4,判断是否长图
        if ($request->file('image')->getClientOriginalExtension() == 'mp4') {
            copy($request->file('image'), base_path() . '/public/images/catalog/' . $randomString . '.mp4');
            $article->type = '.mp4';
        } else {
            list($originalWidth, $originalHeight) = getimagesize($request->file('image'));
            $ratio = $originalHeight / $originalWidth; 
            if ($ratio < '3.5'){
            Image::make($request->file('image'))
            ->resize(480, null, function ($constraint) {$constraint->aspectRatio();}
            )
            ->insert(base_path() . '/public/images/catalog/watermark.jpg', $zuoyou,10)
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/' . $randomString . '.jpg');
            $article->type = '.jpg';
            } else { 
            Image::make($request->file('image'))
            ->resize(480, null, function ($constraint) {$constraint->aspectRatio();}
            )
            ->insert(base_path() . '/public/images/catalog/watermark.jpg', $zuoyou,10)
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/' . $randomString . '_long.jpg');
            Image::make($request->file('image'))
            ->resize(480, null, function ($constraint) {$constraint->aspectRatio();})
            ->resizeCanvas(480, 285,'top')
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/' . $randomString . '.jpg');
            $article->type = '_long.jpg'; }
        }
        //保存存储名字和extension
        $article->photo = $randomString;
        $article->save();
        return $article;
    }

    public function upvote($photo,Request $request)
    {
        $article = \App\Article::where('photo', $photo)->firstOrFail();
        //notify auther 
        if (Auth::check()){
            App('App\Notification')->notify('article_upvote', Auth::user(), $article->user, $article);
            if ($article->votes()->ByWhom(Auth::id())->count()) {
                // click twice for remove upvote
            $article->votes()->ByWhom(Auth::id())->delete();
            $article->decrement('vote_count', 1);
            } else {
                // first time click
            $article->votes()->create(['user_id' => Auth::id()]);
            $article->increment('vote_count', 1);
            }
        }else{//匿名投票
            App('App\Notification')->nonamenotify('article_upvote', $article->user, $article);
            if ($article->votes()->ByWhom($request->ip())->count()) {
            $article->votes()->ByWhom($request->ip())->delete();
            $article->decrement('vote_count', 1);
            } else {
            $article->votes()->create(['user_id' => $request->ip()]);
            $article->increment('vote_count', 1);
            }
        }
        return $article->vote_count;
    }
}
