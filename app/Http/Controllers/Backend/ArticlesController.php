<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Requests\Admin\PublishRequest;
use App\Http\Requests\DeleteArticleRequest;
use App\Models\Article;
use App\Repositories\Articles\ArticleRepositoryInterface;
use App\Services\ArticleService;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * Create a new authentication controller instance.
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {

        $this->middleware('acl:article.update', ['only' => ['edit','update']]);
        $this->middleware('acl:article.delete', ['only' => ['destroy']]);
        $this->middleware('acl:article.publish', ['only' => ['editPublishingForm','publish']]);
        $this->middleware('acl:article.trash', ['only' => ['trash']]);
        $this->middleware('acl:article.restore', ['only' => ['restore']]);

        view()->share('currentUser', Auth::user());

        view()->share('notifications_count',Auth::user()->notifyTo()->where('new','=',1)->count());

        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the article.
     *
     * @param Request $request
     * @param ArticleRepositoryInterface $articleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ArticleRepositoryInterface $articleRepository)
    {
        if($filter = $request->input('filter'))
        {
            $dir = $request->input('dir') ? $request->input('dir') : 'dsc';
            $search = $request->input('search') ? $request->input('search') : '';

            $articles = $articleRepository->searchArticlesByTitle($search , $filter, $dir);
        }
        else
        {
            $filter = 'created_at';
            $dir = 'dsc';
            $search = '';
            $articles = $articleRepository->allArticles();
        }

        return view('admin.articles.index', compact('articles','filter','dir','search'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $article = $this->articleRepository->previewArticle($id);

        $tag_list_with_count = $this->articleRepository->getTagsWitCount($article);

        $comments = $article->comments()->latest()->paginate(4);

        return view('admin.articles.show', compact('article', 'tag_list_with_count', 'comments'));
    }

    /**
     * Preview the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preview($slug)
    {
        $article = $this->articleRepository->previewArticleWithSlug($slug);

        $tag_list_with_count = $this->articleRepository->getTagsWitCount($article);

        $comments = $article->comments()->latest()->paginate(4);

        return view('public.articles.preview', compact('article', 'tag_list_with_count', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = $this->articleRepository->withTrashed()->first($id);

        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Show the form.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPublishingForm($id)
    {
        $article = $this->articleRepository->first($id);

        $tag_list_with_count = $this->articleRepository->getTagsWitCount($article);

        return view('admin.articles.editPublishingForm', compact('article','tag_list_with_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param $id
     * @param ArticleService $articleService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, $id, ArticleService $articleService)
    {
        $article = $this->articleRepository->first($id);

        $articleService->updateArticle($request, $article);

        return redirect()->route('admin.article.index');
    }

    /**
     * Publish the specified article.
     *
     * @param PublishRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(PublishRequest $request, $id)
    {

        $article = $this->articleRepository->first($id);

        $article->update($request->all());

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param DeleteArticleRequest $request
     * @param ArticleService $articleService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, DeleteArticleRequest $request, ArticleService $articleService)
    {
        $article = $this->articleRepository->first($id);

        $articleService->deleteArticle($request, $article);

        return redirect()->back();
    }

    public function trash()
    {
        $articles = $this->articleRepository->onlyTrashed()->paginate(4);

        return view('admin.articles.trash',compact('articles'));
    }

    public function restore($id)
    {
        $article = $this->articleRepository->withTrashed()->first($id);

        $article->restore();

        return redirect()->back();
    }
}
