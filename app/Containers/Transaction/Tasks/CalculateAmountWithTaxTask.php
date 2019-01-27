<?php

namespace App\Containers\Transaction\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class CalculateAmountWithTaxTask extends Task {

    /**
     * @param int $amount
     *
     * @return int
     */
    public function run(int $amount): int {
        $taxPercentage = Config::get('transaction-container.tax-percentage', 0);
        $tax = $amount * $taxPercentage / 100;

        return $amount + $tax;
    }
}
