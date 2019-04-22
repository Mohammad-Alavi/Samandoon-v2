<?php

namespace App\Containers\Tag\Tasks;

use App\Containers\Tag\Models\Tag;
use App\Ship\Parents\Tasks\Task;

class SearchTagTask extends Task
{
    /**
     * @param     $data
     * @param int $limit
     *
     * @return Collection
     */
    public function run($data, $limit = 10)
    {
        /** @var Collection $result */
        $result = Tag::Search($data['q'])->where('type', $data['tag_type'])->paginate($limit);
        return $result;
    }
}
