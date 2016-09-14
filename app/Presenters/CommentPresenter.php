<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class CommentPresenter extends Presenter
{

    public function likesCount( $comment, $currentUser)
    {
        return $comment->likes()->byUser($currentUser->id)->count();
    }

    public function disLikesCount( $comment, $currentUser)
    {
        return $comment->dislikes()->byUser($currentUser->id)->count();
    }
}