<?php
namespace App\Repositories\Articles;

use App\Repositories\Db\Repository;
use Carbon\Carbon;

/**
 * Class ArticleRepository
 * @package App\Repositories\Articles
 */
class ArticleRepository extends Repository implements  ArticleRepositoryInterface
{
    /**
     * @var string
     */
    protected $namespace = 'App\Models\Article';

    public function makeModel()
    {
        $this->model = new $this->namespace();
    }

    public function allPublishedArticles($perPage = 8, $columns = array('*'), $pageName = 'page')
    {
        return $this->model
            ->where('published_at','<=',Carbon::now())
            ->orderBy('published_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function allPublishedArticlesForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' )
    {
        return $this->model
            ->where('user_id', $user->id)
            ->where('published_at','<=',Carbon::now())
            ->orderBy('published_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function findArticleWithSlug($slug)
    {
        return $this->model
            ->whereSlug($slug)
            ->where('published_at','<=',Carbon::now())
            ->firstOrFail();
    }
}