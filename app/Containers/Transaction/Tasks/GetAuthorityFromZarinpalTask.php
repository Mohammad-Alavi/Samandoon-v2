<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Exceptions\AuthorityNotCreatedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;
use Zarinpal\Zarinpal;

class GetAuthorityFromZarinpalTask extends Task {

    /**
     * @var Zarinpal
     */
    protected $zarinpal;

    public function __construct() {
        /** @var string $merchantId */
        $merchantId = Config::get('transaction-container.gateway.zarinpal.merchant_id');
        /** @var Zarinpal $zarinpal */
        $this->zarinpal = new Zarinpal($merchantId);
    }

    /**
     * @param User   $user
     * @param int    $amount
     * @param string $description
     *
     * @return string
     */
    public function run(User $user, int $amount, string $description = 'N/A'): string {
        $results = $this->zarinpal->request(
            route('web_transaction_verify_transaction'),
            $amount,
            $description,
            $user->email,
            $user->phone
        );

        if (isset($results['Authority'])) {
            return $results['Authority'];
        } else {
            throw new AuthorityNotCreatedException();
        }
    }
}
