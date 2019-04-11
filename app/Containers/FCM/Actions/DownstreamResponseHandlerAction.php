<?php

namespace App\Containers\FCM\Actions;

use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DownstreamResponseHandlerAction extends SubAction
{
    public function run($downstreamResponse)
    {
        try {
            Apiato::call('FCM@DeleteFCMTokenTask', [$downstreamResponse->tokensToDelete()]);
            Apiato::call('FCM@UpdateFCMTokenTask', [$downstreamResponse->tokensToModify()]);
//         Apiato::call('FCM@ResendFCMTokenTask', [$downstreamResponse->tokensToRetry()]); // TODO implemend resend fcm token task
        } catch (Exception $exception) {
            throw new ProcessFailedException($exception->getMessage());
        }
    }
}
