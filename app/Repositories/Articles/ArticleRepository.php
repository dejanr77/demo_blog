<?php
namespace App\Repositories\Articles;

use App\Models\Article;
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

    public function getTagsWitCount(Article $article,$columns = array('*'))
    {
        return $article->tags()
            ->withCount(['articles' => function ($query) {
                $query->where('published_at','<=',Carbon::now());
            }])
            ->get($columns);
    }

    public function allArticles($perPage = 8, $columns = array('*'), $pageName = 'page')
    {
        return $this->orderBy('created_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function searchArticlesByTitle($title = '', $orderBy = 'created_at', $dir = 'dsc',  $perPage = 8, $columns = array('*'), $pageName = 'page')
    {
            return $this->orderBy($orderBy, $dir)
                ->where('%'.$title.'%','title', 'like')
                ->paginate($perPage, $columns, $pageName);
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

    public function allArticlesForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' )
    {
        return $this->where($user->id,'user_id' )
            ->orderBy('created_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    public function findArticleWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->getFirst();
    }

    public function findPublishedArticleWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->where(Carbon::now(),'published_at','<=')
            ->getFirst();
    }

    public function previewArticleWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->withTrashed()
            ->getFirst();
    }

    public function previewArticle($id)
    {
        return $this->where($id,'id')
            ->withTrashed()
            ->getFirst();
    }
}