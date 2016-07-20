<?php
namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @param $value
     * @param string $attribute
     * @return mixed
     */
    public function where($value, $attribute = 'id');

    /**
     * @param $slug
     * @return mixed
     */
    public function whereSlug($slug);

    /**
     * @param $attribute
     * @param string $direction
     * @return mixed
     */
    public function orderBy($attribute, $direction = 'asc');


    /**
     * @param $relations
     * @return mixed
     */
    public function with($relations);

    /**
     * @param $relationCount
     * @return mixed
     */
    public function withCount($relationCount);

    /**
     * @param $relations
     * @return mixed
     */
    public function has($relations);

    /**
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = ['*']);

    /**
     * @param array $columns
     * @return mixed
     */
    public function getFirst($columns = ['*']);

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return mixed
     */
    public function paginate($perPage = 25, $columns = ['*'], $pageName = 'page');

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $value
     * @param string $attribute
     * @param array $columns
     * @return mixed
     */
    public function first($value, $attribute = 'id', $columns = ['*']);

    /**
     * @param $relation
     * @param array $data
     * @return mixed
     */
    public function createByUser($relation,array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}