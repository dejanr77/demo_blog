<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Services\UserActivityService;
use Gate;
use Illuminate\Http\Request;

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
     * @param UserActivityService $userActivity
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CommentRequest $request, UserActivityService $userActivity)
    {
        $article = Article::findOrFail($request->input('article_id'));

        if ($request->ajax() || $request->wantsJson())
        {
            if (empty($article)) return response()->json(404);

            if (!$article->status_comment) return response()->json(403);

            $article->increment('comment_count');

            $comment = $request->user()->comments()->create($request->all());

            $comment = view('public.articles.comments.show', compact('comment'))->render();

            if ($comment) return response()->json($comment,200);

            return response()->json(500);
        }

        $article->increment('comment_count');

        $comment = $request->user()->comments()->create($request->all());

        $userActivity->log($request,$comment,'The new comment has sent.');

        return redirect()->route('public.article.show',['article' => $article->slug,'#comment_area']);
    }
}


