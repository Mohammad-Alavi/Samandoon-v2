<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Data\Repositories\TransactionRepository;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateTransactionTask extends Task {

    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * CreateTransactionTask constructor.
     *
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return Transaction
     */
    public function run(array $data): Transaction {
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
