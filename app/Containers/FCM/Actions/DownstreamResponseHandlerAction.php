<?php

namespace App\Containers\FCM\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\FCM\Exceptions\CouldNotHandleDownstreamResponseException;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Parents\Exceptions\Exception;

class DownstreamResponseHandlerAction extends SubAction
{
    /**
     * @param $downstreamResponse
     */
    public function run($downstreamResponse)
    {
        try {
//            Apiato::call('FCM@DeleteFCMTokenTask', [$downstreamResponse->tokensToDelete()]);
//            Apiato::call('FCM@UpdateFCMTokenTask', [$downstreamResponse->tokensToModify()]);
//         Apiato::call('FCM@ResendFCMTokenTask', [$downstreamResponse->tokensToRetry()]); // TODO implemend resend fcm token task
        } catch (Exception $exception) {
            throw new CouldNotHandleDownstreamResponseException($exception->getMessage());
        }
    }
}
