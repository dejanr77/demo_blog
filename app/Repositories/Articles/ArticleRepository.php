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
        return $this->where(Carbon::now(),'published_at','<=')
            ->orderBy('published_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function allPublishedArticlesForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' )
    {
        return $this->where($user->id,'user_id' )
            ->where(Carbon::now(),'published_at','<=')
            ->orderBy('published_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function findArticleWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->where(Carbon::now(),'published_at','<=')
            ->getFirst();
    }
}