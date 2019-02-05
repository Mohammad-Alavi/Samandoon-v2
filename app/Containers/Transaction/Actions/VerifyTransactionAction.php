<?php

namespace App\Containers\Transaction\Actions;

use App\Containers\Transaction\Exceptions\BadTransactionGatewayException;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Transaction\Tasks\FindTransactionByAuthorityTask;
use App\Containers\Transaction\UI\WEB\Requests\VerifyTransactionRequest;
use App\Ship\Parents\Actions\Action;

class VerifyTransactionAction extends Action {

    /**
     * @var FindTransactionByAuthorityTask
     */
    protected $findTransactionByAuthorityTask;

    /**
     * @var VerifyZarinpalTransactionSubAction
     */
    protected $verifyZarinpalTransactionSubAction;

    /**
     * VerifyTransactionAction constructor.
     *
     * @param FindTransactionByAuthorityTask     $findTransactionByAuthorityTask
     * @param VerifyZarinpalTransactionSubAction $verifyZarinpalTransactionSubAction
     */
    public function __construct(FindTransactionByAuthorityTask $findTransactionByAuthorityTask, VerifyZarinpalTransactionSubAction $verifyZarinpalTransactionSubAction) {
        $this->findTransactionByAuthorityTask = $findTransactionByAuthorityTask;
        $this->verifyZarinpalTransactionSubAction = $verifyZarinpalTransactionSubAction;
    }

    /**
     * @param VerifyTransactionRequest $request
     *
     * @return bool
     */
    public function run(VerifyTransactionRequest $request): bool {
        /** @var string $authority */
        $authority = $request['Authority'];
        /** @var Transaction $transaction */
        $transaction = $this->findTransactionByAuthorityTask->run($authority);

        switch ($transaction->gateway) {
            case 'zarinpal':
                return $this->verifyZarinpalTransactionSubAction->run($transaction);
//            case 'payline':
//                return $this->verifyPaylineTransactionSubAction->run($transaction);

            default:
                throw new BadTransactionGatewayException();
        }

    }
}
