<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Data\Repositories\ContentRepository;
use App\Containers\Content\Models\Content;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteContentTask
 *
 * @package App\Containers\Content\Tasks
 */
class DeleteContentTask extends Task
{

    protected $repository;

    /**
     * DeleteContentTask constructor.
     *
     * @param ContentRepository $repository
     */
    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return int
     */
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
