<?php

namespace App\Services;

use App\Repositories\Tags\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagService
{
    /**
     * @var TagRepositoryInterface
     */
    private $tagRepository;
    /**
     * @var UserActivityService
     */
    private $userActivity;


    /**
     * Create a new authentication controller instance.
     * @param TagRepositoryInterface $tagRepository
     * @param UserActivityService $userActivity
     */
    public function __construct(TagRepositoryInterface $tagRepository, UserActivityService $userActivity)
    {
        $this->tagRepository = $tagRepository;
        $this->userActivity = $userActivity;
    }




    /**
     * Save a new tag.
     *
     * @param Request $request
     * @return mixed
     */
    public function createTag(Request $request)
    {
        $tag = $this->tagRepository->createByUser('tags',[
            'name' => $request->input('name'),
            'ip_address' => $request->ip()
        ]);

        $this->userActivity->log($request, $tag, '<i class="fa fa-tag" aria-hidden="true"></i> Tag "'. $tag->name . '</a>" was created');


        flash()->overlay('Tag "'.$tag->name.'" has been successfully created.', 'Tag creating');

        return $tag;
    }

    /**
     * Update an tag.
     *
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function updateTag(Request $request, $slug)
    {
        $tag = $this->tagRepository->findTagWithSlug($slug);

        $this->tagRepository->update([
            'name' => $request->input('name'),
            'ip_address' => $request->ip(),
        ],$tag);


        $this->userActivity->log($request, $tag, '<i class="fa fa-tag" aria-hidden="true"></i> Tag "' . $tag->name . '</a>" was updated');

        flash()->overlay('Tag "'.$tag->name.'" has been successfully updated.', 'Tag updating');

        return $tag;
    }

    /**
     * Delete an tag
     *
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function deleteTag(Request $request, $slug)
    {
        $tag = $this->tagRepository->findTagWithSlug($slug);

        $this->userActivity->log($request, $tag, '<i class="fa fa-tag" aria-hidden="true"></i> Tag "' . $tag->name . '" was deleted');

        flash()->overlay('Tag "'.$tag->name.'" has been successfully deleted.', 'Tag deleting');

        $this->tagRepository->delete($tag);

        return $tag;
    }



}