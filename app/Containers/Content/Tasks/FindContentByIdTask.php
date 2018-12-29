<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindContentByIdTask extends Task
{

    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
