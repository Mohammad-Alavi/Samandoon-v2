<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\FCMToken;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class StoreUserFCMTokenTask extends Task
{
    protected $userFcmToken;

    public function __construct(FCMToken $userFcmToken)
    {
        return $this->userFcmToken = $userFcmToken;
    }

    public function run($data, $userId)
    {
        try {
            if (array_key_exists('device_type', $data) && $data['device_type'] == 'ios') {
                /** @var FCMToken $FCMTokenData */
                $FCMTokenData = FCMToken::firstOrCreate([
                    'apns_id' => $data['token'],
                ], [
                    'user_id' => $userId,
                    'apns_id' => $data['token'],
                ]);
            }
            else {
                $FCMTokenData = FCMToken::firstOrCreate([
                    'android_fcm_token' => $data['token'],
                ], [
                    'user_id' => $userId,
                    'android_fcm_token' => $data['token'],
                ]);
            }

            if (strlen($FCMTokenData->android_fcm_token[0]) > 1) {
                $FCMTokenData->android_fcm_token = $FCMTokenData->android_fcm_token[0];
            }

            if (strlen($FCMTokenData->apns_id[0]) > 1) {
                $FCMTokenData->apns_id = $FCMTokenData->apns_id[0];
            }

            return $FCMTokenData;
        } catch (Exception $exception) {
            throw new CreateResourceFailedException('Failed to store new Token with error: ' . $exception->getMessage());
        }
    }
}