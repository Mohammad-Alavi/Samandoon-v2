<?php

namespace App\Containers\User\Traits;


trait RandomGeneratorTrait {

    /**
     * @param int $digitsSize
     * @return int
     */
    public function getRandomNumber(int $digitsSize): int {
        return rand(pow(10, $digitsSize - 1), pow(10, $digitsSize) - 1);
    }
}