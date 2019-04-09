<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\UserFollowedNotification;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Validation\UnauthorizedException;

class FollowAction extends Action
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

        // throw if user is trying to follow itself
        throw_if($targetUser->id == $AuthenticatedUser->id, UnauthorizedException::class, 'User cannot follow itself');

        $result = Apiato::call('User@FollowTask', [$AuthenticatedUser, $targetUser]);

        // send notification
        $targetUser->notifyNow(new UserFollowedNotification($AuthenticatedUser), ['fcm', 'database']);

        return $result;
    }
}
