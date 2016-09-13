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

    public function where($value, $attribute = 'id', $option = '=')
    {
        $this->model = $this->model->where($attribute, $option, $value);
        return $this;
    }

    public function whereSlug($slug)
    {
        $this->model = $this->model->whereSlug($slug);
        return $this;
    }

    public function orderBy($attribute, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($attribute, $direction);
        return $this;
    }

    public function with($relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    public function withTrashed()
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }

    public function withCount($relationCount)
    {
        $this->model = $this->model->withCount($relationCount);
        return $this;
    }

    public function has($relations)
    {
        $this->model = $this->model->has($relations);
        return $this;
    }

    public function getAll($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function getFirst($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    public function restore()
    {
        return $this->model->restore();
    }

    public function paginate($perPage = 25, $columns = ['*'], $pageName = 'page')
    {
        return $this->model->paginate($perPage, $columns, $pageName);
    }


    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function first($value, $attribute = 'id', $columns = ['*'])
    {
        return $this->model->where($attribute, '=',$value)->firstOrFail($columns);
    }

    public function createByUser($relation,array $data)
    {
        return auth()->user()->$relation()->create($data);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($data, $model)
    {
        $this->model = $model;
        $this->model->update($data);
        return $this->model;
    }

    public function delete($model)
    {
        $this->model = $model;
        $this->model->delete();
        return $this->model;
    }
}