<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Data\Repositories\TransactionRepository;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTransactionByIdTask extends Task {

    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * FindTransactionByIdTask constructor.
     *
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return Transaction
     */
    public function run(int $id): Transaction {
        try {
            return $this->repository->findById($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
