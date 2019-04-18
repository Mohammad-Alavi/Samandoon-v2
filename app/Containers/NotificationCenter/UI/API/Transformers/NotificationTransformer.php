<?php

namespace App\Containers\NotificationCenter\UI\API\Transformers;

use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use Vinkla\Hashids\Facades\Hashids;

class NotificationTransformer
{
    /**
     * @param $notifications
     *
     * @return array
     */
    public function transform($notifications)
    {
        $userTransformer = new UserTransformer();
        $tempArray = [];

        foreach ($notifications as $notification) {
            $response = [
                'id' => $notification->id,
                'type' => $notification->type,
                'user' => array_key_exists('doer_id', $notification->data) ?
                    $userTransformer->transform(User::where('id', '=', $notification->data['doer_id'])->first()) : null,
//                'doer_name' => array_key_exists('doer_name', $notification->data) ? $notification->data['doer_name'] : null,
                'object_id' => array_key_exists('object_id', $notification->data) ? Hashids::encode($notification->data['object_id']) : null,
                'object_text' => array_key_exists('object_text', $notification->data) ? $notification->data['object_text'] : null,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
                'updated_at' => $notification->updated_at,
            ];

            array_push($tempArray, $response);
        }

        $paginatedDataArray = $notifications->toArray();

        $data = [
            'data' => $tempArray,
            'meta' => [
                'pagination' => [
                    'total' => $paginatedDataArray['total'],
                    'per_page' => $paginatedDataArray['per_page'],
                    'current_page' => $paginatedDataArray['current_page'],
                    'total_pages' => $paginatedDataArray['last_page'],
                    'links' => [],
                ],
            ],
        ];

        return $data;
    }
}
