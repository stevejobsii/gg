<?php namespace App\Http\Controllers;

use App\Article;
use Auth;
use App\User;
use App\Reply;
use App\Vote;
use Illuminate\Http\Request as urlRequest;
use App\Http\Requests\AvatarRequest;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
   
    
    public function __construct(){
        $this->middleware('auth', ['only' => ['edit', 'update', 'destroy','settings']]);
    }

    public function settings()
    {
       return view('users.settings');
    }

    public function avatarupdate(AvatarRequest $request)
    {
        Image::make($request->file('avatar'))
            ->resize(100, 100)
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/avatar' . Auth::id() . '.jpg');
        return redirect('settings');
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

    
    //user->article, show the user articles
    public function articles(urlRequest $request,$id)
    {
        //查找这个user,look articles.index
        $user = User::findOrFail($id);
        if($search = $request->query('q'))
        {
        $articles = Article::whose($user->id)->search($search)->orderBy('created_at', 'desc')->paginate(18);
        }else{
        $articles = Article::whose($user->id)->orderBy('created_at', 'desc')->paginate(18);}
        $articles->setPath('articles');
        //sidebar
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(10)->get();
        $hotreplies =  \App\Reply::orderBy('vote_count', 'desc')->limit(10)->get();
        return view('articles.index',compact('articles','search','user','hotimgs','hotreplies'));
    }
    
    //user->relpies
    public function replies($id)
    {
        $user = User::findOrFail($id);
        $replies = Reply::whose($user->id)->recent()->paginate(30);
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
}
