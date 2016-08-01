<?php

namespace App\Repositories\Profiles;


use App\Repositories\Db\Repository;

class ProfileRepository extends Repository implements ProfileRepositoryInterface
{
    /**
     * @var string
     */
    protected $namespace = 'App\Models\Profile';

    public function makeModel()
    {
        $this->model = new $this->namespace();
    }
}