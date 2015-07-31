<?php namespace good\Vote;

use Reply;
use Auth;
use Topic;
use Vote;
use Carbon;
use User;
use Notification;

class Voter
{
    public $notifiedUsers = [];

    public function articleUpVote(Topic $article)
    {
        if ($article->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $article->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $article->decrement('vote_count', 1);
        } elseif ($article->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $article->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $article->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $article->increment('vote_count', 2);
        } else {
            // first time click
            $article->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $article->increment('vote_count', 1);

            //Notification::notify('topic_upvote', Auth::user(), $topic->user, $topic);
        }
    }

    public function articleDownVote(Topic $article)
    {
        if ($article->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // click second time for remove downvote
            $article->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $article->increment('vote_count', 1);
        } elseif ($article->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // user already clicked upvote once
            $article->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $article->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $article->decrement('vote_count', 2);
        } else {
            // click first time
            $article->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $article->decrement('vote_count', 1);
        }
    }

    public function replyUpVote(Reply $reply)
    {
        if (Auth::id() == $reply->user_id) {
            return \Flash::warning(lang('Can not vote your feedback'));
        }

        if ($reply->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $reply->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $reply->decrement('vote_count', 1);
        } elseif ($reply->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $reply->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 2);
        } else {
            // first time click
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 1);

            //Notification::notify('reply_upvote', Auth::user(), $reply->user, $reply->topic, $reply);
        }
    }
}
