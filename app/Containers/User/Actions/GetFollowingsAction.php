<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetFollowingsAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     */
    public function run(DataTransporter $dataTransporter)
    {
        $AuthenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');

        return Apiato::call('User@GetFollowingsTask', [$AuthenticatedUser, $dataTransporter->limit]);
    }
}
