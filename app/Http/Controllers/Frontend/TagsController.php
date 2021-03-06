<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Tags\TagRepositoryInterface;
use Auth;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * @var TagRepositoryInterface
     */
    private $tagRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;

        view()->share('currentUser', Auth::user());
    }

    /**
     * Display a listing of the tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagRepository->allTagsWithCount(['articles' => function ($query) {
            $query->where('published_at','<=',Carbon::now());
        }]);

        return view('public.tags.index', compact('tags'));
    }

    /**
     * Display articles associated with a given tag.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles($slug)
    {
        $tag = $this->tagRepository->findTagWithSlug($slug);

        $articles = $this->tagRepository->allPublishedArticlesForTag($tag, 6);

        return view('public.tags.articles', compact('tag', 'articles'));
    }


}
