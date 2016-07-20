<?php

namespace App\Repositories\Tags;


use App\Repositories\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $relationCount
     * @param array $columns
     * @return mixed
     */
    public function allTagsWithCount( $relationCount, $columns = array('*'));

    /**
     * @param $slug
     * @return mixed
     */
    public function findTagWithSlug($slug);
}