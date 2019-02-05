<?php

namespace App\Containers\Transaction\UI\API\Transformers;

use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Transformers\Transformer;

class TransactionTransformer extends Transformer {

    /**
     * @param Transaction $transaction
     *
     * @return array
     */
    public function transform(Transaction $transaction) {

        $response = [
            'object'      => 'Transaction',
            'id'          => $transaction->getHashedKey(),
            'amount'      => $transaction->amount,
            'points'      => $transaction->points,
            'gateway'     => $transaction->gateway,
            'authority'   => $transaction->authority,
            'payment_url' => $transaction->payment_url,
            'ref_id'      => $transaction->ref_id,
            'description' => $transaction->description,
            'created_at'  => $transaction->created_at,
            'updated_at'  => $transaction->updated_at,
            'paid_at'     => $transaction->paid_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $transaction->id,
            'deleted_at' => $transaction->deleted_at,
        ], $response);

        return $response;
    }
}
