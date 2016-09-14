<?php

namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Notify;
use App\Repositories\Comments\CommentRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class CommentService
{

    /**
     * @var UserActivityService
     */
    private $userActivity;
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserActivityService $userActivity
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct( UserActivityService $userActivity, CommentRepositoryInterface $commentRepository)
    {
        $this->userActivity = $userActivity;
        $this->commentRepository = $commentRepository;
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

        $comment = $this->commentRepository->createByUser('comments',$request->all());

        $this->userActivity->log($request,$comment,'<i class="fa fa-comment-o" aria-hidden="true"></i> You are commented "'.$article->title.'" article.');

        Notify::notify($comment->user_id, $article->user_id, $comment, '<i class="fa fa-comment-o" aria-hidden="true"></i> '. $comment->user->present()->publicFullName(). ' has commented your article ');

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
        $icon = ( $type == 'like' ) ? 'fa fa-thumbs-o-up' : 'fa fa-thumbs-o-down';

        if ($model) {
            $model->delete();
            $comment->decrement($column);

            Notify::notify($user->id, $comment->user_id, $comment, '<i class="text-danger '. $icon .'" aria-hidden="true"></i>  '. $user->present()->publicFullName(). ' has no longer '.$type.'d your comment on article');

            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'down'], 200);
        } else {
            $comment->$relation()->create(['user_id' => $user->id]);
            $comment->increment($column);

            Notify::notify($user->id, $comment->user_id, $comment, '<i class="text-primary '. $icon .'" aria-hidden="true"></i>  '. $user->present()->publicFullName(). ' has '.$type.'d your comment on article');


            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'up'], 200);
        }

        if ($request->ajax() || $request->wantsJson())
            return response()->json(500);


        return redirect()->route('public.article.show', ['article' => $article->slug]);
    }

    /**
     * Delete an comment
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function deleteComment(Request $request,$id)
    {
        $comment = $this->commentRepository->findComment($id);

        $this->commentRepository->delete($comment);

        $this->userActivity->log($request,$comment,'<i class="fa fa-comment-o" aria-hidden="true"></i> You are deleted comment.');

        flash()->overlay('Comment has been successfully deleted.', 'Comment deleting');

        $comment->delete();

        return $comment;
    }

    /**
     * Restore an comment
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function restoreComment(Request $request, $id)
    {
        $comment = $this->commentRepository->findComment($id);

        $comment->restore();

        $this->userActivity->log($request,$comment,'<i class="fa fa-comment-o" aria-hidden="true"></i> You are restored comment.');

        flash()->overlay('Comment has been successfully restored.', 'Comment restoring');

        return $comment;

    }
}