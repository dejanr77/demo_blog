<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\Articles\ArticleRepositoryInterface;
use App\User;

use App\Http\Requests;
use Gate;
use Illuminate\Http\Request;

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

    public function status($id,Request $request)
    {
        $article = $this->articleRepository->first($id);

        if ($request->ajax() || $request->wantsJson()) {
            if (empty($article))
                return response()->json(404);

            if (Gate::denies('status', $article))
                return response()->json(403);

            if($article->update(['status' => $request->input('value')])) return response()->json(200);

            return response()->json(500);
        }
        $this->authorize('status',$article);

        $article->update(['status' => $request->input('value')]);

        return redirect()->route('public.userCenters.articles',['user' => $article->user_id]);
    }

    public function comments($id, Request $request)
    {
        $article = $this->articleRepository->first($id);

        if ($request->ajax() || $request->wantsJson()) {
            if (empty($article))
                return response()->json(404);

            if (Gate::denies('comments', $article))
                return response()->json(403);

            if($article->update(['comments' => $request->input('value')])) return response()->json(200);

            return response()->json(500);
        }
        $this->authorize('comments',$article);

        $article->update(['comments' => $request->input('value')]);

        return redirect()->route('public.userCenters.articles',['user' => $article->user_id]);
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->with(['user.profile'])->allPublishedArticles(4);

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

        return redirect()->route('public.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article = $this->articleRepository->findPublishedArticleWithSlug($slug);

        $tag_list_with_count = $article->tags()->withCount('articles')->get();

        return view('public.articles.show', compact('article', 'tag_list_with_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('edit', $article);

        return view('public.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $this->updateArticle($request, $article);

        return redirect()->route('public.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArticleRequest $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleRequest $request, Article $article)
    {
        $this->authorize('delete', $article);

        $this->deleteArticle($request, $article);

        return redirect()->route('public.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(ArticleRequest $request, $id)
    {
        $article = $this->articleRepository->first($id);

        $userId = $article->user_id;

        $this->authorize('delete', $article);

        $this->deleteArticle($request, $article);

        return redirect()->route('public.userCenters.articles',['user' => $userId]);
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
     * Log activity for user.
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @param $content
     */
    private function logActivity(ArticleRequest $request, Article $article, $content)
    {
        $request->user()->activities()->create([
            'ip_address' => $request->ip(),
            'type' => class_basename($article),
            'type_id' => $article->id,
            'content' => $content
        ]);
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

        $this->logActivity($request, $article, 'Article "' . $article->title . '" was created');

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

        $this->logActivity($request, $article, 'Article "' . $article->title . '" was updated');

        $this->syncTags($article, $request->input('tags'));

        flash()->overlay('Article "'.$article->title.'" has been successfully updated.', 'Article updating');

        return $article;
    }

    /**
     * Delete an article
     *
     * @param ArticleRequest $request
     * @param $article
     */
    private function deleteArticle(ArticleRequest $request, $article)
    {
        $this->logActivity($request, $article, 'Article "' . $article->title . '" was deleted');

        flash()->overlay('Article "'.$article->title.'" has been successfully deleted.', 'Article deleting');

        $this->articleRepository->delete($article);
    }
}
