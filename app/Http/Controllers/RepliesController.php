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

class RepliesController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
    //回复需要填写body,最重要的store功能
    public function store(ReplyRequest $request)
    {
        
        $request['user_id'] = Auth::id();
        
        Reply::create($request->all());

        //阅读＋1
        $article = Article::find($request['article_id']);
        $article->reply_count++;
        $article->updated_at = Carbon::now();
        $article->save();
        return  back();
    }

    public function vote($id)
    {
        $reply = Reply::find($id);
        App::make('Phphub\Vote\Voter')->replyUpVote($reply);
        return Redirect::route('topics.show', [$reply->topic_id, '#reply'.$reply->id]);
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($reply->user_id);
        $reply->delete();

        $reply->topic->decrement('reply_count', 1);

        Flash::success(lang('Operation succeeded.'));

        $reply->topic->generateLastReplyUserInfo();

        return Redirect::route('topics.show', $reply->topic_id);
    }
}
