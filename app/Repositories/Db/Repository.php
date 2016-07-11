<?php
namespace App\Repositories\Db;

use App\Repositories\RepositoryInterface;

abstract class Repository implements  RepositoryInterface
{

    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract function makeModel();

    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    public function all($perPage = 8, $columns = array('*'), $pageName = 'page')
    {
        return $this->model
            ->Orderby('created_at', 'DESC')
            ->paginate($perPage, $columns, $pageName);
    }

    public function allForUser($user, $perPage = 8, $columns = array('*'), $pageName = 'page' )
    {
        return $this->model->where('user_id', $user->id)
            ->Orderby('created_at', 'DESC')
            ->paginate($perPage, $columns, $pageName);
    }
}