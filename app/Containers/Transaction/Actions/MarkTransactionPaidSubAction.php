<?php

namespace App\Containers\Transaction\Actions;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Transaction\Tasks\UpdateTransactionTask;
use App\Ship\Parents\Actions\SubAction;
use Carbon\Carbon;

class MarkTransactionPaidSubAction extends SubAction {

    /**
     * @var UpdateTransactionTask
     */
    protected $updateTransactionTask;

    /**
     * MarkTransactionPaidSubAction constructor.
     *
     * @param UpdateTransactionTask $updateTransactionTask
     */
    public function __construct(UpdateTransactionTask $updateTransactionTask) {
        $this->updateTransactionTask = $updateTransactionTask;
    }

    /**
     * @param Transaction $transaction
     * @param string      $refId
     *
     * @return void
     */
    public function run(Transaction $transaction, string $refId) {
        $data = [
            'ref_id'  => $refId,
            'paid_at' => Carbon::now()
        ];
        $this->updateTransactionTask->run($transaction->id, $data);
    }
}
