<?php

namespace App\Containers\FCM\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\FCM\UI\API\Requests\StoreUserFCMTokenRequest;
use App\Containers\FCM\UI\API\Transformers\FCMTokenTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    /**
     * @param StoreUserFCMTokenRequest $request
     *
     * @return array
     */
    public function storeUserFCMToken(StoreUserFCMTokenRequest $request)
    {
        $fcm = Apiato::call('FCM@StoreUserFCMTokenAction', [new DataTransporter($request)]);
        $fcmTransformer = new FCMTokenTransformer();
        return $fcmTransformer->transform($fcm);
    }
}
