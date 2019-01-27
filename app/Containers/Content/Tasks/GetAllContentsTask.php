<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllContentsTask extends Task
{

    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
