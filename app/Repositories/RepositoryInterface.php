<?php
namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @param array $relations
     * @return mixed
     */
    public function with(array $relations);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $user
     * @return mixed
     */
    public function allForUser($user);
}