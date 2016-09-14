<?php
namespace App\Repositories\Comments;

use App\Repositories\Db\Repository;


class CommentRepository extends Repository implements  CommentRepositoryInterface
{
    /**
     * @var string
     */
    protected $namespace = 'App\Models\Comment';


    public function makeModel()
    {
        $this->model = new $this->namespace();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allComments($perPage = 8, $columns = array('*'), $pageName = 'page')
    {
        return $this
            ->orderBy('created_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allDeletedComments($perPage = 8, $columns = array('*'), $pageName = 'page')
    {
        return $this
            ->onlyTrashed()
            ->orderBy('created_at','dsc')
            ->paginate($perPage, $columns, $pageName);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findComment($id) {
        return $this->where($id,'id')
            ->withTrashed()
            ->getFirst();
    }
}