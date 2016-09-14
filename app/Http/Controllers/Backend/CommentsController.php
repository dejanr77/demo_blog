<?php

namespace App\Http\Controllers\Backend;

use App\Models\Comment;
use App\Repositories\Comments\CommentRepositoryInterface;
use App\Services\CommentService;
use Auth;
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
        view()->share('currentUser', Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @param CommentRepositoryInterface $commentRepository
     * @return \Illuminate\Http\Response
     */
    public function index(CommentRepositoryInterface $commentRepository)
    {
        $comments = $commentRepository->allComments(4);

        return view('admin.comments.index',compact('comments'));
    }


    /**
     * Display the specified resource.
     *
     * @param CommentRepositoryInterface $commentRepository
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(CommentRepositoryInterface $commentRepository, $id)
    {
        $comment = $commentRepository->findComment($id);

        return view('admin.comments.show',compact('comment'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CommentService $commentService
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, CommentService $commentService, $id)
    {
        $commentService->deleteComment($request, $id);

        return redirect()->route('admin.comment.index');
    }

    /**
     * Display a listing of deleted comment.
     *
     * @param CommentRepositoryInterface $commentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash(CommentRepositoryInterface $commentRepository)
    {
        $comments = $commentRepository->allDeletedComments(4);

        return view('admin.comments.trash',compact('comments'));
    }

    /**
     * Restore a deleted comment.
     *
     * @param Request $request
     * @param CommentService $commentService
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request, CommentService $commentService,$id)
    {
        $commentService->restoreComment($request, $id);

        return redirect()->back();
    }

}
