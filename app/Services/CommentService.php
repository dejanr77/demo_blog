<?php

namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;

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

    /**
     * Change like value in DB.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function likeUpOrDown($id, Request $request)
    {
        $comment = Comment::findOrFail($id);

        $user = $request->user();

        return $this->increaseOrDecreaseCount('like', $request, $comment, $user);
    }

    /**
     * Change like value in DB.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function dislikeUpOrDown($id, Request $request)
    {
        $comment = Comment::findOrFail($id);

        $user = $request->user();

        return $this->increaseOrDecreaseCount('dislike', $request, $comment, $user);
    }

    /**
     * @param $type
     * @param Request $request
     * @param Comment $comment
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function increaseOrDecreaseCount($type, Request $request,Comment $comment,User $user)
    {
        $article = $comment->article;

        $column = $type.'_count';
        $relation = $type.'s';
        $model = $comment->$relation()->byUser($user->id)->first();

        if ($model) {
            $model->delete();
            $comment->decrement($column);

            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'down'], 200);
        } else {
            $comment->$relation()->create(['user_id' => $user->id]);
            $comment->increment($column);

            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'up'], 200);
        }

        if ($request->ajax() || $request->wantsJson())
            return response()->json(500);


        return redirect()->route('public.article.show', ['article' => $article->slug]);
    }
}