<?php

namespace App\Containers\User\UI\API\Transformers;

use Vinkla\Hashids\Facades\Hashids;

class FCMTokenTransformer
{
    /**
     * @param $entity
     *
     * @return array
     */
    public function transform($entity)
    {
        $response = [
//            'object' => 'UserFCMToken',
//            'id' => Hashids::encode($entity->id),
            'user_id' => Hashids::encode($entity->user_id),
            'android_fcm_token' => $entity->android_fcm_token,
            'apns_id' => $entity->apns_id,
        ];

        return $response;
    }
}
