<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetUserFeedAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     */
    public function run(DataTransporter $dataTransporter)
    {
        $authenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');
        return Apiato::call('User@GetUserFeedTask', [$authenticatedUser, $dataTransporter->limit]);
    }
}
