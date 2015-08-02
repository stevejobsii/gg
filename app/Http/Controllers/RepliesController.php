<?php namespace App\Http\Controllers;

use App\Reply;
use App\article;
use App\Vote;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller {
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->beforeFilter('auth');
    // }

    public function store(ReplyRequest $request)
    {
        
        $request['user_id'] = Auth::id();
       
        Reply::create($request->all());

        // Add the reply user
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

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    // public function creatorFailed($errors)
    // {
    //     Flash::error(lang('Operation failed.'));
    //     return Redirect::back();
    // }

    // public function creatorSucceed($reply)
    // {
    //     Flash::success(lang('Operation succeeded.'));
    //     return Redirect::route('topics.show', array(Input::get('topic_id'), '#reply'.$reply->id));
    // }
}
