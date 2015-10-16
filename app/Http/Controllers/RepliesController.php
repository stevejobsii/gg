<?php namespace App\Http\Controllers;

use App\Reply;
use App\Article;
use App\Vote;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ReplyRequest;
use App\good\Notification\Mention;

class RepliesController extends Controller
{
    protected $mentionParser;

    public function __construct(Mention $mentionParser)
    {
        $this->middleware('auth', ['except' => ['upvote']]);
        $this->mentionParser = $mentionParser;
    }
    //回复需要填写body,最重要的store功能
    public function store(ReplyRequest $request)
    {
        //save reply
        $request['user_id'] = Auth::id();
        $request['body'] = $this->mentionParser->parse($request['body']);
        //return  $request['body'];   
        $reply = Reply::create($request->all());
        //reply count＋1
        $article = Article::find($request['article_id']);
        $article->reply_count++;
        $article->updated_at = Carbon::now();
        $article->save();
        //通知  after user  
        App('App\good\Notification\Notifier')->newReplyNotify(Auth::user(), $this->mentionParser, $article, $reply);
        return  back();
    }

    public function upvote($id,Request $request)
    {
        //upvote reply
        $reply = Reply::find($id);
        //notify commenter
        if (Auth::check()){
            App('App\Notification')->notify('reply_upvote', Auth::user(), $reply->user, $reply->article, $reply);
            if ($reply->votes()->ByWhom(Auth::id())->count()) {
                // click twice for remove upvote
            $reply->votes()->ByWhom(Auth::id())->delete();
            $reply->decrement('vote_count', 1);
            $reply->article()->decrement('vote_count', 1);
            } else {
                // first time click
            $reply->votes()->create(['user_id' => Auth::id()]);
            $reply->increment('vote_count', 1);
            $reply->article()->increment('vote_count', 1);
            }
        }else{//匿名投票
            App('App\Notification')->nonamenotify('reply_upvote', $reply->user, $reply->article, $reply);
            if ($reply->votes()->ByWhom($request->ip())->count()) {
            $reply->votes()->ByWhom($request->ip())->delete();
            $reply->decrement('vote_count', 1);
            } else {
            $reply->votes()->create(['user_id' => $request->ip()]);
            $reply->increment('vote_count', 1);
            }
        }
        return $reply->vote_count;
    }

    public function destroy($id)
    {
        //destroy reply
        $reply = \App\Reply::findOrFail($id);
        //权限
        $this->authorOrAdminPermissioinRequire($reply->user_id);
        $reply->article->decrement('reply_count', 1);
        //delete Vote 
        $reply->votes()->delete();
        $reply->delete();
        return redirect('articles/'. $reply->article->photo);
    }
}
