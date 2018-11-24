<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateContentTask extends Task {

    /**
     * @var ContentRepository
     */
    protected $repository;

    /**
     * CreateContentTask constructor.
     *
     * @param ContentRepository $repository
     */
    public function __construct(ContentRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function run(array $data = []) {
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
