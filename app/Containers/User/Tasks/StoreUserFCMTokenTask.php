<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\FCMTokenRepository;
use App\Containers\User\Models\FCMToken;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Models\Model;
use App\Ship\Parents\Tasks\Task;
use Exception;

class StoreUserFCMTokenTask extends Task
{
    /** @var FCMTokenRepository $repository */
    protected $repository;

    /**
     * StoreUserFCMTokenTask constructor.
     *
     * @param FCMTokenRepository $repository
     */
    public function __construct(FCMTokenRepository $repository)
    {
        return $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return FCMToken|Model
     */
    public function run(array $data)
    {
        $FCMTokenData = null;
        try {
            if (array_key_exists('device_type', $data) && $data['device_type'] == 'ios') {
                // Retrieve FCMToken or create it with the user_id, user_access_token, and apns_id attributes...
                /** @var FCMToken $FCMTokenData */
                $FCMTokenData =  $this->repository->firstOrCreate([
                    'user_id' => $data['user_id'],
                    'user_access_token' => $data['user_token'],
                    'apns_id' => $data['token'],
                ]);
            }
//            dd($data);

            if (array_key_exists('device_type', $data) && $data['device_type'] == 'android') {
                // Retrieve FCMToken or create it with the user_id, user_access_token, and android_fcm_token attributes...
                /** @var FCMToken $FCMTokenData */
                $FCMTokenData = $this->repository->firstOrCreate([
                    'user_id' => $data['user_id'],
                    'user_access_token' => $data['user_token'],
                    'android_fcm_token' => $data['token'],
                ]);
            }
        } catch (Exception $exception) {
            throw new CreateResourceFailedException('Failed to store new Token with error: ' . $exception->getMessage() . ' | On Line: ' . $exception->getLine());
        }

        return $FCMTokenData;
    }
}