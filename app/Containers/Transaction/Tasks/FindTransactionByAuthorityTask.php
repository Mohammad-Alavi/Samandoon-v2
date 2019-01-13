<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Data\Repositories\TransactionRepository;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTransactionByAuthorityTask extends Task {

    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * FindTransactionByAuthorityTask constructor.
     *
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string $authority
     *
     * @return Transaction
     */
    public function run(string $authority): Transaction {
        try {
            return $this->repository->findByAuthority($authority);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
