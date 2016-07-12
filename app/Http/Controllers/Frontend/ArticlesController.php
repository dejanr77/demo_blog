<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Repositories\Articles\ArticleRepositoryInterface;
use App\User;

use App\Http\Requests;

class ArticlesController extends Controller
{

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->with(['user'])->allPublishedArticles(4);

        return view('public.articles.index', compact('articles'));
    }

    /**
     * Display a listing of the article that written by a user.
     *
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user($name)
    {
        $user = User::where('name', $name)->first();

        $articles = $this->articleRepository->allPublishedArticlesForUser($user, 6);

        return view('public.articles.user', compact('articles','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $this->articleRepository->createByUser('articles',$request->all());

        return redirect()->route('public.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article = $this->articleRepository->findArticleWithSlug($slug);

        return view('public.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article  = $this->articleRepository->first($id);

        return view('public.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $this->articleRepository->update($request->all(),$id);

        return redirect()->route('public.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->articleRepository->delete($id);

        return redirect()->route('public.articles.index');
    }
}
