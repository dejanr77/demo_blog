<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Notify;
use App\Repositories\Articles\ArticleRepositoryInterface;
use App\User;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ArticleService
{

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;
    /**
     * @var UserActivityService
     */
    private $userActivity;

    /**
     * Create a new authentication controller instance.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param UserActivityService $userActivity
     */
    public function __construct(ArticleRepositoryInterface $articleRepository, UserActivityService $userActivity)
    {
        $this->articleRepository = $articleRepository;

        $this->userActivity = $userActivity;
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
     * @param $type
     * @param Article $article
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function ajaxHandler($type, Article $article, Request $request)
    {
        if (empty($article))
            return response()->json(404);

        if (Gate::denies(substr($type,7), $article))
            return response()->json(403);

        if ($article->update([ $type => $request->input('value')]))
            return response()->json(200);

        return response()->json(500);
    }

    /**
     * Changes the value of the column in the database for the specified article.
     *
     * @param $column
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function changesValueInDb($column, Request $request, Article $article)
    {
        if ($request->ajax() || $request->wantsJson())
        {
            return $this->ajaxHandler($column, $article, $request);
        }

        if (Gate::denies(substr($column,7), $article)) throw new AuthorizationException('This action is unauthorized.');

        $article->update([$column => $request->input('value')]);

        return redirect()->route('public.userCenters.articles',['user' => $article->user_id]);
    }

    /**
     * Save a new article.
     *
     * @param Request $request
     * @return mixed
     */
    public function createArticle(Request $request)
    {
        $tags = $this->ifItHasNewTagsCreate($request);

        $article = $this->articleRepository->createByUser('articles', $request->all());

        $this->userActivity->log($request, $article, '<i class="fa fa-plus-square-o" aria-hidden="true"></i> Article "'. $article->title . '</a>" was created');

        $this->syncTags($article, $tags);

        flash()->overlay('Article "'.$article->title.'" has been successfully created.', 'Article creating');

        return $article;
    }

    /**
     * Update an article.
     *
     * @param Request $request
     * @param $article
     * @return mixed
     */
    public function updateArticle(Request $request, $article)
    {
        $input = $request->all();

        $tags = $this->ifItHasNewTagsCreate($request);

        $input['status_comment'] = isset($input['status_comment']) ? $input['status_comment'] : 0;

        $article = $this->articleRepository->update($input, $article);

        $this->userActivity->log($request, $article, '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Article "' . $article->title . '</a>" was updated');

        $this->syncTags($article, $tags);

        flash()->overlay('Article "'.$article->title.'" has been successfully updated.', 'Article updating');

        return $article;
    }

    /**
     * Delete an article
     *
     * @param Request $request
     * @param $article
     */
    public function deleteArticle(Request $request, $article)
    {
        $this->userActivity->log($request, $article, '<i class="fa fa-ban" aria-hidden="true"></i> Article "' . $article->title . '" was deleted');

        flash()->overlay('Article "'.$article->title.'" has been successfully deleted.', 'Article deleting');

        $this->articleRepository->delete($article);
    }

    /**
     * @param Request $request
     * @return array|string
     */
    private function ifItHasNewTagsCreate(Request $request)
    {
        $tags = $request->input('tags');

        foreach ($tags as $ktag => $vtag)
        {
            if (starts_with($vtag, 'new:'))
            {
                $tag = $request->user()->tags()->create([
                    'name' => substr($vtag, 4),
                    'ip_address' => $request->ip()
                ]);

                $this->userActivity->log($request, $tag, '<i class="fa fa-tag" aria-hidden="true"></i> Tag "' . $tag->name . '" was created');

                $tags[$ktag] = $tag->id;
            }
        }
        return $tags;
    }

    /**
     * Change like value in DB.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function likeUpOrDown($id, Request $request)
    {
        $article = Article::findOrFail($id);

        $user = $request->user();

        return $this->increaseOrDecreaseCount('like', $request, $article, $user);
    }

    /**
     * Change like value in DB.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function dislikeUpOrDown($id, Request $request)
    {
        $article = Article::findOrFail($id);

        $user = $request->user();

        return $this->increaseOrDecreaseCount('dislike', $request, $article, $user);
    }

    /**
     * @param $type
     * @param Request $request
     * @param Article $article
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function increaseOrDecreaseCount($type, Request $request,Article $article,User $user)
    {
        $type = strtolower(trim($type));
        $column = $type.'_count';
        $relation = $type.'s';
        $model = $article->$relation()->byUser($user->id)->first();
        $icon = ( $type == 'like' ) ? 'fa fa-thumbs-o-up' : 'fa fa-thumbs-o-down';

        if ($model) {
            $model->delete();
            $article->decrement($column);

            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'down'], 200);
        } else {
            $article->$relation()->create(['user_id' => $user->id]);
            $article->increment($column);

            if ($request->ajax() || $request->wantsJson())
                return response()->json(['action' => 'up'], 200);
        }

        if ($request->ajax() || $request->wantsJson())
            return response()->json(500);


        return redirect()->route('public.article.show', ['article' => $article->slug]);
    }

}