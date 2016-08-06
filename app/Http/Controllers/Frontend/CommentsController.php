<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Services\CommentService;
use App\Services\UserActivityService;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @param CommentService $commentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request, CommentService $commentService)
    {
        $article = Article::findOrFail($request->input('article_id'));

        if ($request->ajax() || $request->wantsJson())
        {
            return $commentService->forAjaxCreateComment($article, $request);
        }

        $commentService->createComment($article,$request);

        return redirect()->route('public.article.show',['article' => $article->slug,'#comment_area']);
    }
}


