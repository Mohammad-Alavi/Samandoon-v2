<?php

namespace App\Containers\Transaction\Actions;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\User\Actions\AddPointsToUserSubAction;
use App\Containers\User\Notifications\PointsAddedNotification;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Support\Facades\Config;
use Zarinpal\Zarinpal;

class VerifyZarinpalTransactionSubAction extends SubAction {

    /**
     * @var MarkTransactionPaidSubAction
     */
    protected $markTransactionPaidSubAction;

    /**
     * @var AddPointsToUserSubAction
     */
    protected $addPointsToUserSubAction;

    /**
     * @var Zarinpal
     */
    protected $zarinpal;

    /**
     * VerifyZarinpalTransactionSubAction constructor.
     *
     * @param MarkTransactionPaidSubAction $markTransactionPaidSubAction
     * @param AddPointsToUserSubAction     $addPointsToUserSubAction
     */
    public function __construct(MarkTransactionPaidSubAction $markTransactionPaidSubAction, AddPointsToUserSubAction $addPointsToUserSubAction) {
        $this->markTransactionPaidSubAction = $markTransactionPaidSubAction;
        $this->addPointsToUserSubAction = $addPointsToUserSubAction;

        /** @var string $merchantId */
        $merchantId = Config::get('transaction-container.gateway.zarinpal.merchant_id');
        /** @var Zarinpal $zarinpal */
        $this->zarinpal = new Zarinpal($merchantId);
    }

    /**
     * @param Transaction $transaction
     *
     * @return bool
     */
    public function run(Transaction $transaction): bool {
        $result = $this->zarinpal->verify($transaction->amount, $transaction->authority);

        $isVerified = ($result) && ($result['Status'] == 'success');
        if ($isVerified){
            /** @var string $refId */
            $refId = $result['RefID'];
            $this->markTransactionPaidSubAction->run($transaction, $refId);
            $this->addPointsToUserSubAction->run($transaction->user, $transaction->points);
            //$transaction->user->notify(new PointsAddedNotification($transaction->points));
            return true;
        }else
            return false;
    }
}
