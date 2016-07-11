<?php
namespace App\Repositories\Articles;

use App\Repositories\Db\Repository;

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
}