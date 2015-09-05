<?php namespace App;

use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;

class Notification extends \Eloquent
{
    use PresentableTrait;
    public $presenter = 'App\good\Presenters\NotificationPresenter';

    // Don't forget to fill this array
    protected $fillable = [
            'from_user_id',
            'user_id',
            'article_id',
            'reply_id',
            'body',
            'type'
            ];
    //这些notification输入1个user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    //一个user有很多通知,notification属于一个user
    public function fromUser()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    /**
     * Create a notification
     * @param  [type] $type     currently have 'at', 'new_reply', 'attention', 'append'
     * @param  User   $fromUser come from who
     * @param  array   $users   to who, array of users
     * @param  Topic  $topic    cuurent context
     * @param  Reply  $reply    the content
     * @return [type]           none
     */
    //noti reply 2people auther/@User
    public static function batchNotify($type, User $fromUser, $users, Article $article, Reply $reply = null, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];

        foreach ($users as $toUser) {
            if ($fromUser->id == $toUser->id) {
                continue;
            }

            $data[] = [
                'from_user_id' => $fromUser->id,
                'user_id'      => $toUser->id,
                'article_id'   => $article->id,
                'reply_id'     => $content ?: $reply->id,
                'body'         => $content ?: $reply->body,
                'type'         => $type,
                'created_at'   => $nowTimestamp,
                'updated_at'   => $nowTimestamp
            ];

            $toUser->increment('notification_count', 1);
        }

        if (count($data)) {
            Notification::insert($data);
        }
    }

    //noti auther,main vote
    public static function notify($type, User $fromUser, User $toUser, Article $article, Reply $reply = null)
    {

        if ($fromUser->id == $toUser->id) {
            return;
        }
        
        if (Notification::isNotified($fromUser->id, $toUser->id, $article->id, $type)) {
            return;
        }
       
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data[] = [
            'from_user_id' => $fromUser->id,
            'user_id'      => $toUser->id,
            'article_id'   => $article->id,
            'reply_id'     => $reply ? $reply->id : 0,
            'body'         => $reply ? $reply->body : '',
            'type'         => $type,
            'created_at'   => $nowTimestamp,
            'updated_at'   => $nowTimestamp
        ];       
        $toUser->increment('notification_count', 1);
        Notification::insert($data);
        
    }
    
    public static function isNotified($from_user_id, $user_id, $article_id, $type)
    {
        $notifys = Notification::fromwhom($from_user_id)
                        ->toWhom($user_id)
                        ->atTopic($article_id)
                        ->withType($type)->get();
        return $notifys->count();
    }

    public function scopeFromWhom($query, $from_user_id)
    {
        return $query->where('from_user_id', '=', $from_user_id);
    }

    public function scopeToWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    public function scopeAtTopic($query, $article_id)
    {
        return $query->where('article_id', '=', $article_id);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
