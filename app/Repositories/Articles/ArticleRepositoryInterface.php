<?php
namespace App\Repositories\Articles;

use App\Models\Article;
use App\Repositories\RepositoryInterface;

interface ArticleRepositoryInterface extends  RepositoryInterface
{
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
    public function findPublishedArticleWithSlug($slug);

    /**
     * @param $slug
     * @return mixed
     */
    public function previewArticleWithSlug($slug);
}