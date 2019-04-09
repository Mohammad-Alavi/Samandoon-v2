<?php

namespace App\Containers\NotificationCenter\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\NotificationCenter\UI\API\Requests\GetNotificationsRequest;
use App\Containers\NotificationCenter\UI\API\Transformers\NotificationTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    public function getNotifications(GetNotificationsRequest $request)
    {
        $notifications = Apiato::call('NotificationCenter@GetNotificationsAction', [new DataTransporter($request)]);
        $notiTransformer = new NotificationTransformer();
        return $notiTransformer->transform($notifications);
    }
}
