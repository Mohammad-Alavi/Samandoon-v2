<?php

namespace App\Containers\NotificationCenter\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Auth;

class GetNotificationsAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
        $notifications = Apiato::call('NotificationCenter@GetNotificationsTask', [$transporter->limit, $user]);
        return $notifications;
    }
}
