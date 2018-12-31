<?php

namespace App\Containers\Transaction\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Transaction\UI\API\Requests\CreateTransactionRequest;
use App\Containers\Transaction\UI\API\Requests\GetAllTransactionsRequest;
use App\Containers\Transaction\UI\API\Transformers\TransactionTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Parents\Requests\Request;

class Controller extends ApiController {
    /**
     * @param CreateTransactionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTransaction(CreateTransactionRequest $request) {
        $transaction = Apiato::call('Transaction@CreateTransactionAction', [$request]);

        return $this->created($this->transform($transaction, TransactionTransformer::class));
    }

    /**
     * @param GetAllTransactionsRequest $request
     *
     * @return array
     */
    public function getAllTransactions(GetAllTransactionsRequest $request) {
        $transactions = Apiato::call('Transaction@GetAllTransactionsAction', [$request]);

        return $this->transform($transactions, TransactionTransformer::class);
    }

}
