<?php

namespace App\Containers\Repost\Tasks;

use App\Containers\Repost\Data\Repositories\RepostRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateRepostTask extends Task
{

    protected $repository;

    public function __construct(RepostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
