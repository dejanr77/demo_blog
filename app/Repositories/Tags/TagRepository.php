<?php

namespace App\Repositories\Tags;


use App\Models\Tag;
use App\Repositories\Db\Repository;
use Carbon\Carbon;

class TagRepository extends  Repository implements TagRepositoryInterface
{

    private $namespace = 'App\Models\Tag';

    function makeModel()
    {
        $this->model = new $this->namespace();
    }

    public function allTagsWithCount($relationCount,$columns = array('*'))
    {
        return $this
            ->withCount($relationCount)
            ->orderBy('created_at','dsc')
            ->getAll($columns);
    }

    public function paginateTagsWithCount($relationCount,$prePage)
    {
        return $this
            ->withCount($relationCount)
            ->orderBy('created_at','dsc')
            ->paginate($prePage);
    }

    public function findTagWithSlug($slug)
    {
        return $this->whereSlug($slug)
            ->getFirst();
    }

    public function allPublishedArticlesForTag(Tag $tag, $prePage = 8)
    {
        return $tag->articles()
            ->where('published_at','<=',Carbon::now())
            ->orderBy('published_at','dsc')
            ->paginate($prePage);
    }
}