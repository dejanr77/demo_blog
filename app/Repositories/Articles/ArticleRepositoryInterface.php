<?php
namespace App\Repositories\Articles;

use App\Models\Article;
use App\Repositories\RepositoryInterface;

interface ArticleRepositoryInterface extends  RepositoryInterface
{
    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allArticles($perPage = 8, $columns = array('*'), $pageName = 'page');

    /**
     * @param string $title
     * @param string $orderBy
     * @param string $dir
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function searchArticlesByTitle($title = '', $orderBy = 'created_at', $dir = 'dsc', $perPage = 8, $columns = array('*'), $pageName = 'page');

    /**
     * @param Article $article
     * @param array $columns
     * @return mixed
     */
    public function getTagsWitCount(Article $article,$columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allPublishedArticles($perPage = 8, $columns = array('*'), $pageName = 'page');

    /**
     * @param $user
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allPublishedArticlesForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' );

    /**
     * @param $user
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allArticlesForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' );

    /**
     * @param $slug
     * @return mixed
     */
    public function findArticleWithSlug($slug);

    /**
     * @param $slug
     * @return mixed
     */
    public function findPublishedArticleWithSlug($slug);

    /**
     * @param $slug
     * @return mixed
     */
    public function previewArticleWithSlug($slug);

    /**
     * @param $id
     * @return mixed
     */
    public function previewArticle($id);
}