<?php

namespace App\Containers\Link\Tasks;

use App\Containers\Link\Data\Repositories\LinkRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteLinkTask
 *
 * @package App\Containers\Link\Tasks
 */
class DeleteLinkTask extends Task
{

    protected $repository;

    /**
     * DeleteLinkTask constructor.
     *
     * @param LinkRepository $repository
     */
    public function __construct(LinkRepository $repository)
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
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
