<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Services\CommentService;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        view()->share('currentUser', Auth::user());
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

    /**
     * @param $id
     * @param Request $request
     * @param CommentService $commentService
     * @return mixed
     */
    public function like($id, Request $request, CommentService $commentService)
    {
        return $commentService->likeUpOrDown($id,$request);
    }

    /**
     * @param $id
     * @param Request $request
     * @param CommentService $commentService
     * @return mixed
     */
    public function dislike($id, Request $request, CommentService $commentService)
    {
        return $commentService->dislikeUpOrDown($id,$request);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect()->back();
    }

}


