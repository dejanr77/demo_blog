<?php

namespace App\Http\Composers;


use App\Models\Tag;
use Illuminate\Contracts\View\View;

class ArticleFormComposer {

    public function compose(View $view)
    {
        $view->with('tag_list', Tag::pluck('name', 'id'));
    }
} 