<?php

namespace App\Containers\Transaction\Data\Repositories;

use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Repositories\Repository;

class TransactionRepository extends Repository {

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];


    /**
     * @param int $id
     *
     * @return Transaction
     */
    public function findById(int $id): Transaction {
        $transaction = $this->findByField('id', $id)->first();

        if ($transaction == null)
            throw new NotFoundException();
        else
            return $transaction;
    }

    /**
     * @param string $authority
     *
     * @return Transaction
     */
    public function findByAuthority(string $authority): Transaction {
        $transaction = $this->findByField('authority', $authority)->first();

        if ($transaction == null)
            throw new NotFoundException();
        else
            return $transaction;
    }

    /**
     * @param string $refId
     *
     * @return Transaction
     */
    public function findByRefId(string $refId): Transaction {
        $transaction = $this->findByField('ref_id', $refId)->first();

        if ($transaction == null)
            throw new NotFoundException();
        else
            return $transaction;
    }

}
