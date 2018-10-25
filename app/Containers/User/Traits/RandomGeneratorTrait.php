<?php
/**
 * Created by PhpStorm.
 * User: MosleM
 * Date: 10/21/2018
 * Time: 7:04 PM
 */

namespace App\Containers\User\Traits;


trait RandomGeneratorTrait {
    public function getRandomNumber($digits): int{
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }
}