<?php

namespace App\Repositories\Tags;


use App\Repositories\Db\Repository;

class TagRepository extends  Repository implements TagRepositoryInterface
{

    private $namespace = 'App\Models\Tag';

    function makeModel()
    {
        $this->model = new $this->namespace();
    }

    public function allTags($columns = array('*'))
    {
        return $this->getAll($columns);
    }

    public function findTagWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->getFirst();
    }
}