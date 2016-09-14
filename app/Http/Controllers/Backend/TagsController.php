<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Tags\TagRepositoryInterface;
use App\Services\TagService;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{


    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('acl:tag.menage', ['except' => ['create','store']]);
        $this->middleware('acl:tag.create', ['only' => ['create','store']]);

        view()->share('currentUser', Auth::user());

    }

    /**
     * Display a listing of the resource.
     *
     * @param TagRepositoryInterface $tagRepository
     * @return \Illuminate\Http\Response
     */
    public function index(TagRepositoryInterface $tagRepository)
    {
        $tags = $tagRepository->paginateTagsWithCount('articles',8);

        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param TagService $tagService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TagService $tagService)
    {
        $tagService->createTag($request);

        return redirect()->route('admin.article.tag.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @param TagRepositoryInterface $tagRepository
     * @return \Illuminate\Http\Response
     * @internal param $slug
     */
    public function edit($slug, TagRepositoryInterface $tagRepository)
    {
        $tag = $tagRepository->findTagWithSlug($slug);

        return view('admin.tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $slug
     * @param TagService $tagService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, TagService $tagService)
    {
        $tagService->updateTag($request, $slug);

        return redirect()->route('admin.article.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $slug
     * @param TagService $tagService
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $slug, TagService $tagService)
    {
        $tagService->deleteTag($request,$slug);

        return redirect()->route('admin.article.tag.index');
    }
}
