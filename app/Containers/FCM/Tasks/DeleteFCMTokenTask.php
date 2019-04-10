<?php

namespace App\Containers\FCM\Tasks;

use App\Containers\FCM\Data\Repositories\FCMTokenRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteFCMTokenTask extends Task
{

    protected $repository;

    public function __construct(FCMTokenRepository $repository)
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
