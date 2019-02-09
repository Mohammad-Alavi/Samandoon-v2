<?php

namespace App\Containers\Image\Tasks;

use App\Containers\Image\Data\Repositories\ImageRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteImageTask extends Task
{

    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
