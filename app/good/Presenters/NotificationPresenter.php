<?php namespace App\good\Presenters;

use Laracasts\Presenter\Presenter;
use Route;

class NotificationPresenter extends Presenter
{
    public function lableUp()
    {
        switch ($this->type) {
            case 'new_reply':
            $lable = '在您的图片发表了新的评论  ';
                break;
            case 'attention':
                $lable = 'Attented article has new reply:';
                break;
            case 'at':
                $lable = '提及您在  ';
                break;
            case 'article_favorite':
                $lable = 'Favorited your article:';
                break;
            case 'article_attent':
                $lable = 'Attented your article:';
                break;
            case 'article_upvote':
                $lable = '点赞了您的图片  ';
                break;
            case 'reply_upvote':
                $lable = '点赞了您的评论  ';
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
