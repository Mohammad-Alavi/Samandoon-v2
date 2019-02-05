<?php

namespace App\Containers\Transaction\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Transaction\UI\WEB\Requests\VerifyTransactionRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController {
    /**
     * @param VerifyTransactionRequest $request
     *
     * @return mixed
     */
    public function verifyTransaction(VerifyTransactionRequest $request) {
        /** @var bool $status */
        $status = $request['Status'] == 'OK';

        if (!$status)
            return view('transaction::transaction-failed');

        $isVerified = Apiato::call('Transaction@VerifyTransactionAction', [$request]);

        if ($isVerified)
            return view('transaction::transaction-success');
        else
            return view('transaction::transaction-failed');

    }
}
