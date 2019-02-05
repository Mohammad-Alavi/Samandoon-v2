<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Data\Repositories\TransactionRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTransactionTask extends Task {

    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * UpdateTransactionTask constructor.
     *
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function run($id, array $data) {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
