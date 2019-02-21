<?php

namespace App\Containers\Subject\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Spatie\Tags\Tag;

class CreateSubjectTask extends Task
{

    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $content_id, array $data): Tag
    {
        try {
            return $this->repository->addSubject($content_id, $data['subject'], config('samandoon.tag_type.subject'));
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
