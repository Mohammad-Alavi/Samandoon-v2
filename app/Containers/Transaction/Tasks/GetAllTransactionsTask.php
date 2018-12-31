<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Data\Repositories\TransactionRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllTransactionsTask extends Task {

    /**
     * @var TransactionRepository
     */
    protected $repository;

    /**
     * GetAllTransactionsTask constructor.
     *
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function run() {
        return $this->repository->paginate();
    }
}
