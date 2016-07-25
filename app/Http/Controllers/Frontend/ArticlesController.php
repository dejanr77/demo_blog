<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
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
        $this->middleware('auth', ['except' => ['index', 'show', 'user']]);

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
        $this->createArticle($request);

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

        $tag_list_with_count = $article->tags()->withCount('articles')->get();

        return view('public.articles.show', compact('article', 'tag_list_with_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->first($id);

        $this->authorize('edit', $article);

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
        $article = $this->articleRepository->first($id);

        $this->authorize('update', $article);

        $this->updateArticle($request, $article);

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
        $article = $this->articleRepository->first($id);

        $this->authorize('delete', $article);

        $this->deleteArticle($article);

        return redirect()->route('public.articles.index');
    }

    /**
     * Sync up the list of tags in the database.
     *
     * @param Article $article
     * @param array $tags
     * @internal param ArticleRequest $request
     */
    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    /**
     * Save a new article.
     *
     * @param ArticleRequest $request
     * @return mixed
     */
    private function createArticle(ArticleRequest $request)
    {
        $article = $this->articleRepository->createByUser('articles', $request->all());

        $this->syncTags($article, $request->input('tags'));

        flash()->overlay('Article "'.$article->title.'" has been successfully created.', 'Article creating');

        return $article;
    }

    /**
     * Update an article.
     *
     * @param ArticleRequest $request
     * @param $article
     * @return mixed
     */
    private function updateArticle(ArticleRequest $request, $article)
    {
        $article = $this->articleRepository->update($request->all(), $article);

        $this->syncTags($article, $request->input('tags'));

        flash()->overlay('Article "'.$article->title.'" has been successfully updated.', 'Article updating');

        return $article;
    }

    /**
     * Delete an article
     *
     * @param $article
     */
    private function deleteArticle($article)
    {
        flash()->overlay('Article "'.$article->title.'" has been successfully deleted.', 'Article deleting');

        $this->articleRepository->delete($article);
    }
}
