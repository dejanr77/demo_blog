<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\DeleteArticleRequest;
use App\Repositories\Articles\ArticleRepositoryInterface;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Auth;

class PreviewsController extends Controller
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

        view()->share('currentUser', Auth::user());
    }


    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article = $this->articleRepository->previewArticleWithSlug($slug);

        $this->authorize('show',$article);

        $tag_list_with_count = $this->articleRepository->getTagsWitCount($article);

        $comments = $article->comments()->latest()->paginate(4);

        return view('public.previews.show', compact('article', 'tag_list_with_count', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = request()->user();

        $article = $this->articleRepository->first($id);

        $this->authorize('edit', $article);

        return view('public.previews.edit', compact('article','user'));
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

        $this->authorize('update', $article);

        $articleService->updateArticle($request, $article);

        return redirect()->route('public.userCenters.articles',['user' => $article->user_id]);
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

        $this->authorize('delete', $article);

        $articleService->deleteArticle($request, $article);

        return redirect()->route('public.userCenters.articles',['user' => $article->user_id]);
    }

}
