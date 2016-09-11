<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\User;
use Auth;

class DashboardController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        view()->share('currentUser', Auth::user());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::count();
        $articleCount = Article::count();
        $tagCount = Tag::count();
        $commentCount = Comment::count();

        return view('admin.dashboard',compact('userCount','articleCount','tagCount','commentCount'));
    }
}
