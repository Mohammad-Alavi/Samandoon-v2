<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UnfollowAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     * @throws \Throwable
     */
    public function run(DataTransporter $dataTransporter)
    {
        /** @var User $AuthenticatedUser */
        $AuthenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');
        /** @var User $targetUser */
        $targetUser = Apiato::call('User@FindUserByIdTask', [$dataTransporter->id]);

        return Apiato::call('User@UnfollowTask', [$AuthenticatedUser, $targetUser]);
    }
}
