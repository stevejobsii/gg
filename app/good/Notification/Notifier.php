<?php namespace App\good\Notification;

use App\good\Notification\Mention;
use Reply;
use Auth;
use Topic;
use Notification;
use Carbon;
use User;

//input
class Notifier
{
    public $notifiedUsers = [];
    //after user  
    public function newReplyNotify( $fromUser, Mention $mentionParser,  $article,  $reply)
    {
        // Notify the author
        App('App\Notification')->batchNotify(
                    'new_reply',//type
                    $fromUser,
                    $this->removeDuplication([$article->user]),
                    $article,
                    $reply);

        //Notify mentioned users @回复评论者
        App('App\Notification')->batchNotify(
                    'at',
                    $fromUser,
                    $this->removeDuplication($mentionParser->users),
                    $article,
                    $reply);
    }

    // in case of a user get a lot of the same notification
    public function removeDuplication($users)
    {
        $notYetNotifyUsers = [];
        foreach ($users as $user) {
            if (!in_array($user->id, $this->notifiedUsers)) {
                $notYetNotifyUsers[] = $user;
                $this->notifiedUsers[] = $user->id;
            }
        }
        return $notYetNotifyUsers;
    }
}
