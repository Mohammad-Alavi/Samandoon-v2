<?php

namespace App\Containers\FCM\Tasks;

use App\Containers\FCM\Data\Repositories\FCMTokenRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateFCMTokenTask extends Task
{

    protected $repository;

    public function __construct(FCMTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
