<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class UpdateContentTask
 *
 * @package App\Containers\Content\Tasks
 */
class UpdateContentTask extends Task
{

    protected $repository;

    /**
     * UpdateContentTask constructor.
     *
     * @param ContentRepository $repository
     */
    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
