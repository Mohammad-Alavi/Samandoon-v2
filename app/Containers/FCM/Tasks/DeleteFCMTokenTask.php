<?php

namespace App\Containers\FCM\Tasks;

use App\Containers\FCM\Models\FCMToken;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteFCMTokenTask extends Task
{
    public function run(array $tokens)
    {
        try {
            return FCMToken::whereIn('android_fcm_token', '=', $tokens)->orWhereIn('apns_id', '=', $tokens)->delete();
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}