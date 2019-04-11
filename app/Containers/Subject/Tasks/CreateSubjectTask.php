<?php

namespace App\Containers\Subject\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Containers\Tag\Models\Tag;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSubjectTask extends Task
{
    protected $repository;

    /**
     * CreateSubjectTask constructor.
     *
     * @param ContentRepository $repository
     */
    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int   $content_id
     * @param array $data
     *
     * @return Tag
     */
    public function run(int $content_id, array $data): Tag
    {
        try {
            return $this->repository->addSubject($content_id, $data['subject'], config('samandoon.tag_type.subject'));
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
