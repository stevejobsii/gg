<?php namespace App\Http\Controllers;

use App\Article;
use Auth;
use Hash;
use App\User;
use App\Reply;
use App\Vote;
use Request;
use Illuminate\Http\Request as urlRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordresetRequest;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
   
    
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update', 'destroy','settings']]);
    }

    public function settings()
    {
        $user = Auth::user();
        return View('users.settings', compact('user'));
    }

    public function avatarupdate(AvatarRequest $request)
    {
        Image::make($request->file('avatar'))
            ->resize(100, 100)
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/avatar' . Auth::id() . '.jpg');
        Image::make($request->file('avatar'))
            ->resize(31, 31)
            ->encode('jpg')
            ->save(base_path() . '/public/images/catalog/30avatar' . Auth::id() . '.jpg');
        return redirect('settings');
    }
    
    public function update()
    {  
        $user = Auth::user();
        $user->update(Request::all());
        return redirect('settings');
    }

    protected function resetPassword(PasswordresetRequest $request)
    {
        $user = Auth::user();
      
        if(Hash::check($request->only('old_password')['old_password'], $user->password)){  
        
            $password = $request->only('password')['password'];

            $password_confirmation = $request->only('password_confirmation')['password_confirmation'];

            if(!($password == $password_confirmation)){
                   flash()->info('当前输入新密码与错密码不一致!', '请重新输入');
                   return redirect('settings');
            } else {

            $user->password = Hash::make($request->only('password')['password']);

            $user->save();

            flash()->success('密码修改成功!', 'Have a good time!');

            return redirect('settings');}

        } else {
            
            flash()->error('输入当前密码输入错误!', '请重新输入');
            
            return redirect('settings');
        }
    }

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
        $hotimgs = \App\Article::where('type','LIKE',"%jpg%")->orderBy('vote_count', 'desc')->take(5)->get();
        $hotreplies =  \App\Reply::orderBy('vote_count', 'desc')->limit(5)->get();
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
}
