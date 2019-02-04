<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

class UserPrivateProfileTransformer extends Transformer {

    /**
     * @var  array
     */
    protected $availableIncludes = [
//        'roles',
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
        /** @var UserTransformer $userTransformer */
        $userTransformer = new UserTransformer();

        $response = [
            'user' => $userTransformer->transform($user),

//            'settings' => $settings,
//            'stats'    => $stats,
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
