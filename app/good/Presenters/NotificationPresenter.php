<?php namespace App\good\Presenters;

use Laracasts\Presenter\Presenter;
use Route;

class NotificationPresenter extends Presenter
{
    public function lableUp()
    {
        switch ($this->type) {
            case 'new_reply':
            $lable = 'Your article have new reply:';
                break;
            case 'attention':
                $lable = 'Attented article has new reply:';
                break;
            case 'at':
                $lable = 'Mention you At:';
                break;
            case 'article_favorite':
                $lable = 'Favorited your article:';
                break;
            case 'article_attent':
                $lable = 'Attented your article:';
                break;
            case 'article_upvote':
                $lable = 'Up Vote your article';
                break;
            case 'reply_upvote':
                $lable = 'Up Vote your reply';
                break;
            case 'article_mark_wiki':
                $lable = 'has mark your article as wiki:';
                break;
            case 'article_mark_excellent':
                $lable = 'has recomended your article:';
                break;
            case 'comment_append':
                $lable = 'Commented article has new update:';
                break;
            case 'attention_append':
                $lable = 'Attented article has new update:';
                break;

            default:
                break;
        }
        return $lable;
    }
}
