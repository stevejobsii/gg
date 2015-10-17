<?php namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Reply;
use App\Vote;
use Illuminate\Http\Request as urlRequest;
use App\Http\Requests\BookmarkRequest;

class UsersController extends Controller
{
   
    
    public function __construct(){
        $this->middleware('auth', ['only' => ['edit', 'update', 'destroy']]);
    }

    //show users/id
    public function show($id)
    {
        $user = User::findOrFail($id);
        $articles = Article::whose($user->id)->recent()->limit(10)->get();
        $replies = Reply::whose($user->id)->recent()->limit(10)->get();

        return view('users.show', compact('user', 'topics', 'replies'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);

        return View::make('users.edit', compact('user', 'topics', 'replies'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);
        $data = Input::only('real_name', 'city', 'company', 'twitter_account', 'personal_website', 'signature', 'introduction');
        App::make('Phphub\Forms\UserUpdateForm')->validate($data);

        $user->update($data);

        Flash::success(lang('Operation succeeded.'));

        return Redirect::route('users.show', $id);
    }

    public function destroy($id)
    {
        $this->authorOrAdminPermissioinRequire($topic->user_id);
    }

    public function bookmark(BookmarkRequest $request)
    { 
        
        $users = Auth::user()->create($request->all());
        $users->bookmark = '300';
        $users->save();
    }

    //user->article, show the user articles
    public function articles(urlRequest $request,$id)
    {
        //查找这个user,look articles.index
        $user = User::findOrFail($id);
        if($search = $request->query('q'))
        {
        $articles = Article::whose($user->id)->search($search)->orderBy('created_at', 'desc')->paginate(15);
        }else{
        $articles = Article::whose($user->id)->orderBy('created_at', 'desc')->paginate(15);}
        $articles->setPath('articles');
        //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(5)->get();
        $hotreplies =  \App\Reply::orderBy('vote_count', 'desc')->limit(5)->get();
        return view('articles.index',compact('articles','search','user','hotimgs','hotreplies'));
    }
    //user->relpies
    public function replies($id)
    {
        $user = User::findOrFail($id);
        $replies = Reply::whose($user->id)->recent()->paginate(30);
        //$articles = Article::
        return view('users.replies', compact('user', 'replies'));
    }
    //user->upvote
    public function upvotes($id)
    {
        $user = User::findOrFail($id);
        $upvotes = Vote::whose($user->id)->recent()->paginate(30);
        return view('users.upvotes', compact('user', 'upvotes'));
    }

    public function blocking($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = (!$user->is_banned);
        $user->save();

        return Redirect::route('users.show', $id);
    }

    public function githubApiProxy($username)
    {
        $cache_name = 'github_api_proxy_user_'.$username;

        //Cache 1 day
        return Cache::remember($cache_name, 1440, function () use ($username) {
            $result = (new GithubUserDataReader())->getDataFromUserName($username);
            return Response::json($result);
        });
    }

    public function githubCard()
    {
        return View::make('users.github-card');
    }

    public function refreshCache($id)
    {
        $user =  User::findOrFail($id);

        $user_info = (new GithubUserDataReader())->getDataFromUserName($user->github_name);

        // Refresh the GitHub card proxy cache.
        $cache_name = 'github_api_proxy_user_'.$user->github_name;
        Cache::put($cache_name, $user_info, 1440);

        // Refresh the avatar cache.
        $user->image_url = $user_info['avatar_url'];
        $user->cacheAvatar();
        $user->save();

        Flash::message(lang('Refresh cache success'));

        return Redirect::route('users.edit', $id);
    }
}
