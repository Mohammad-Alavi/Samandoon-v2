<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetFollowersAction extends Action
{
    public function run(DataTransporter $dataTransporter)
    {
        $AuthenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');

        return Apiato::call('User@GetFollowersTask', [$AuthenticatedUser, $dataTransporter->limit]);
    }
}
