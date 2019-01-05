<?php

namespace App\Containers\Link\Tasks;

use App\Containers\Link\Data\Repositories\LinkRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class UpdateLinkTask
 *
 * @package App\Containers\Link\Tasks
 */
class UpdateLinkTask extends Task
{

    protected $repository;

    /**
     * UpdateLinkTask constructor.
     *
     * @param LinkRepository $repository
     */
    public function __construct(LinkRepository $repository)
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
