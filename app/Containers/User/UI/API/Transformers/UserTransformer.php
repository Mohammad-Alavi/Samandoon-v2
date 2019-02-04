<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

class UserTransformer extends Transformer {

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'roles',
    ];

    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user) {
        $response = [
            'object'                  => 'User',
            'id'                      => $user->getHashedKey(),
            'first_name'              => $user->first_name,
            'last_name'               => $user->last_name,
            'nick_name'               => $user->nick_name,
            'email'                   => $user->email,
            'phone'                   => $user->phone,
            'is_phone_confirmed'      => $user->is_phone_confirmed,
            'is_email_confirmed'      => $user->is_email_confirmed,
            'gender'                  => $user->gender,
            'birth'                   => $user->birth,
            'points'                  => $user->points,
            'is_subscription_expired' => $user->is_subscription_expired,
            'subscription_expired_at' => $user->subscription_expired_at,

            'created_at'          => $user->created_at,
            'updated_at'          => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    /**
     * @param User $user
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRoles(User $user) {
        return $this->collection($user->roles, new RoleTransformer());
    }

}
