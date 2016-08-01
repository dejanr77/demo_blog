<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\DeleteArticleRequest;
use App\Models\Article;
use App\Repositories\Articles\ArticleRepositoryInterface;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PreviewsController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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

        $tag_list_with_count = $article->tags()->withCount('articles')->get();

        return view('public.previews.show', compact('article', 'tag_list_with_count'));
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

        return view('public.previews.edit', compact('article'));
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

        return redirect()->route('public.previews.show',['previews' => $article->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  DeleteArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id, DeleteArticleRequest $request)
    {
        $article = $this->articleRepository->first($id);

        $userId = $article->user_id;

        $this->authorize('delete', $article);

        $this->deleteArticle($request, $article);

        return redirect()->route('public.userCenters.articles',['id' => $userId]);
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
     * Update an article.
     *
     * @param ArticleRequest $request
     * @param $article
     * @return mixed
     */
    private function updateArticle(ArticleRequest $request, $article)
    {
        $input = $request->all();

        $input['comments'] = isset($input['comments']) ? $input['comments'] : 0;

        $article = $this->articleRepository->update($input, $article);

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
