<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Criterias\Eloquent\OrderByFieldCriteria;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Tags\Tag;

class GetAllContentsTask extends Task
{

    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($data)
    {
        // tag && tagType-> exist || is_null || false
        $tag = array_key_exists('tag', $data) ? $data['tag'] : false;
        $tagType = array_key_exists('tag_type', $data) ? $data['tag_type'] : false;

        // if query params exist then try ti find the tag
        if ($tag && $tagType) {
            $tagInstance = Tag::where([
                ['name->en', '=', $tag],
                ['type', '=', $tagType],
            ])->first();

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

        $this->repository->pushCriteria(new OrderByFieldCriteria('created_at', 'desc'));
        return $this->repository->paginate();
    }
}
