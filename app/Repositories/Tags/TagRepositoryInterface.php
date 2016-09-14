<?php

namespace App\Repositories\Tags;


use App\Models\Tag;
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
     * @param $relationCount
     * @param $prePage
     * @return mixed
     */
    public function paginateTagsWithCount($relationCount,$prePage);

    /**
     * @param $slug
     * @return mixed
     */
    public function findTagWithSlug($slug);

    /**
     * @param Tag $tag
     * @param $prePage
     * @return mixed
     */
    public function allPublishedArticlesForTag(Tag $tag, $prePage = 8);
}