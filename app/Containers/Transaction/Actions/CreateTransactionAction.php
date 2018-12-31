<?php

namespace App\Containers\Transaction\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Transaction\Tasks\CalculateAmountWithTaxTask;
use App\Containers\Transaction\Tasks\CalculatePointsTask;
use App\Containers\Transaction\Tasks\CreateTransactionTask;
use App\Containers\Transaction\Tasks\GetAuthorityFromZarinpalTask;
use App\Containers\Transaction\UI\API\Requests\CreateTransactionRequest;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

class CreateTransactionAction extends Action {

    /**
     * @var CreateTransactionTask
     */
    protected $createTransactionTask;

    /**
     * @var GetAuthenticatedUserTask
     */
    protected $getAuthenticatedUserTask;

    /**
     * @var GetAuthorityFromZarinpalTask
     */
    protected $getAuthorityFromZarinpalTask;

    /**
     * @var CalculateAmountWithTaxTask
     */
    protected $calculateAmountWithTaxTask;

    /**
     * @var CalculatePointsTask
     */
    protected $calculatePointsTask;

    /**
     * CreateTransactionAction constructor.
     *
     * @param CreateTransactionTask        $createTransactionTask
     * @param GetAuthenticatedUserTask     $getAuthenticatedUserTask
     * @param GetAuthorityFromZarinpalTask $getAuthorityFromZarinpalTask
     * @param CalculateAmountWithTaxTask   $calculateAmountWithTaxTask
     * @param CalculatePointsTask          $calculatePointsTask
     */
    public function __construct(CreateTransactionTask $createTransactionTask, GetAuthenticatedUserTask $getAuthenticatedUserTask, GetAuthorityFromZarinpalTask $getAuthorityFromZarinpalTask, CalculateAmountWithTaxTask $calculateAmountWithTaxTask, CalculatePointsTask $calculatePointsTask) {
        $this->createTransactionTask = $createTransactionTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
        $this->getAuthorityFromZarinpalTask = $getAuthorityFromZarinpalTask;
        $this->calculateAmountWithTaxTask = $calculateAmountWithTaxTask;
        $this->calculatePointsTask = $calculatePointsTask;
    }

    /**
     * @param CreateTransactionRequest $request
     *
     * @return Transaction
     */
    public function run(CreateTransactionRequest $request): Transaction {
        /** @var User $user */
        $user = $this->getAuthenticatedUserTask->run();
        /** @var int $amount */
        $amount = $this->calculateAmountWithTaxTask->run($request['amount']);
        /** @var int $points */
        $points = $this->calculatePointsTask->run($request['amount']);
        /** @var string $description */
        $description = 'خرید ' . $points . ' امتیاز در آی-ویزیتور';

        $gateway = Config::get('transaction-container.gateway.default');

        $data = [];
        switch ($gateway) {
            case 'zarinpal':
                $data = $this->prepareDataForZarinpal($user, $amount, $points, $description);
                break;
//            case 'xxPay':
//                $data = $this->prepareDataForXxPay($user, $amount, $points, $description);
//                break;
        }

        $transaction = $this->createTransactionTask->run($data);

        return $transaction;
    }

    /**
     * @param User   $user
     * @param int    $amount
     * @param int    $points
     * @param string $description
     *
     * @return array
     */
    private function prepareDataForZarinpal(User $user, int $amount, int $points, string $description): array {
        /** @var string $authority */
        $authority = $this->getAuthorityFromZarinpalTask->run($user, $amount, $description);

        $data = [
            'user_id'     => $user->id,
            'amount'      => $amount,
            'points'      => $points,
            'gateway'     => Config::get('transaction-container.gateway.zarinpal.name'),
            'authority'   => $authority,
            'payment_url' => Config::get('transaction-container.gateway.zarinpal.payment_pre_address') . $authority,
            'description' => $description
        ];

        return $data;
    }
}
