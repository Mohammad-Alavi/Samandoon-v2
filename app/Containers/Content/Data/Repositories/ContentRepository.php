<?php

namespace App\Containers\Content\Data\Repositories;

use App\Containers\Content\Models\Content;
use App\Containers\Tag\Models\Tag;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class ContentRepository
 */
class ContentRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    /**
     * @param int    $content_id
     * @param string $subject
     * @param string $tagType
     *
     * @return Content
     */
    public function addSubject(int $content_id, string $subject, string $tagType = "subject"): Tag
    {
        /** @var Content $content */
        $content = $this->find($content_id);
        $subject = Tag::findOrCreate([$subject], $tagType)->first();
        $content->syncTagsWithType([$subject], $tagType);
        return $subject;
    }

    public function updateSubject(int $content_id, string $subject, string $tagType = "subject"): Tag
    {
        /** @var Content $content */
        $content = $this->find($content_id);
        $subject = Tag::findOrCreate([$subject], $tagType)->first();
        $content->syncTagsWithType([$subject], $tagType);
        return $subject;
    }
}
