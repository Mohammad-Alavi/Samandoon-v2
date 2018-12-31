<?php

namespace App\Containers\Transaction\Tasks;

use App\Ship\Parents\Tasks\Task;

class CalculatePointsTask extends Task {

    /**
     * @param int $amount
     *
     * @return int
     */
    public function run(int $amount): int {
        return $amount;

    }
}
