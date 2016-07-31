<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter
{
    public function publishedAtWithFormatForForm()
    {
        return $this->published_at->format('Y-m-d');
    }

    public function publishedAtWithFormatForPublicShow()
    {
        return $this->published_at->format('F j, Y');
    }

    public function shortenTitle()
    {
        return str_limit($this->title, 32);
    }
}