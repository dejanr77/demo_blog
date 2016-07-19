<?php

namespace App\Repositories\Tags;


use App\Repositories\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function allTags( $columns = array('*'));

    /**
     * @param $slug
     * @return mixed
     */
    public function findTagWithSlug($slug);
}