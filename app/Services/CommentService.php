<?php

namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Article;

class CommentService
{

    /**
     * @var UserActivityService
     */
    private $userActivity;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserActivityService $userActivity
     */
    public function __construct( UserActivityService $userActivity)
    {
        $this->userActivity = $userActivity;
    }


    /**
     * Save a new comment.
     *
     * @param Article $article
     * @param CommentRequest $request
     * @return mixed
     */
    public function createComment(Article $article, CommentRequest $request)
    {
        $article->increment('comment_count');

        $comment = $request->user()->comments()->create($request->all());

        $this->userActivity->log($request,$comment,'The new comment has sent.');

        return $comment;
    }

    /**
     * @param Article $article
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function forAjaxCreateComment(Article $article, CommentRequest $request)
    {

        if (empty($article))
            return response()->json(404);

        if (!$article->status_comment)
            return response()->json(403);

        $comment = $this->createComment($article, $request);

        $comment = view('public.articles.comments.show', compact('comment'))->render();

        if ($comment)
            return response()->json($comment,200);

        return response()->json(500);
    }

}