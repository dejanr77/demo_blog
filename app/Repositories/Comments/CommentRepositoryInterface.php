<?php
namespace App\Repositories\Comments;

use App\Repositories\RepositoryInterface;

interface CommentRepositoryInterface extends  RepositoryInterface
{
    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allComments($perPage = 8, $columns = array('*'), $pageName = 'page');

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function allDeletedComments($perPage = 8, $columns = array('*'), $pageName = 'page');

    /**
     * @param $id
     * @return mixed
     */
    public function findComment($id);
}