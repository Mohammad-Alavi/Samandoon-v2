<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Containers\Tag\Models\Tag;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Builder;

class GetAllContentsTask extends Task
{

    protected $repository;

    /**
     * GetAllContentsTask constructor.
     *
     * @param ContentRepository $repository
     */
    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function run($data)
    {
        // tag && tagType-> exist || is_null || false
        $tag = array_key_exists('tag', $data) ? $data['tag'] : false;
        $tagType = array_key_exists('tag_type', $data) ? $data['tag_type'] : false;
        $user_id = array_key_exists('user_id', $data) ? $data['user_id'] : false;

        // if query params exist then try to find the tag
        if ($tag && $tagType) {
            $tagInstance = Tag::findFromString($tag, $tagType);

            // if tag exist then apply query scope
            if ($tagInstance != null) {
                $this->repository->scopeQuery(function (Builder $query) use ($tagInstance) {
                    return $query->whereHas('tags', function (Builder $query) use ($tagInstance) {
                        $query->where('id', $tagInstance->id);
                    });
                });
            }
            else {
                // if no tag is found then use a fake tag id to just return nothing in query resault
                $this->repository->scopeQuery(function (Builder $query) {
                    return $query->whereHas('tags', function (Builder $query) {
                        $query->where('id', 0);
                    });
                });
            }
        }

        // if query params user_id exist then return all content of the user
        if ($user_id) {
            $this->repository->pushCriteria(new ThisUserCriteria($user_id));
        }
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this->repository->paginate();
    }
}
