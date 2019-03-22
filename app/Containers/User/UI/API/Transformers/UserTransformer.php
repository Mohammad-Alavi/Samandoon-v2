<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User as User;
use App\Ship\Parents\Transformers\Transformer;

class UserTransformer extends Transformer
{

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
    public function transform(User $user)
    {
        /** @var User $currentUser */
        $currentUser = auth('api')->user();

        $response = [
            'object' => 'User',
            'id' => $user->getHashedKey(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'nick_name' => $user->nick_name,
            'description' => $user->description,
            'email' => $user->email,
            'username' => $user->username,
            'public_phone' => $this->obscurePhone($user->phone),
            'is_phone_confirmed' => $user->is_phone_confirmed,
            'is_email_confirmed' => $user->is_email_confirmed,
            'gender' => $user->gender,
            'birth' => $user->birth,
            'points' => $user->points,
            'is_subscription_expired' => $user->is_subscription_expired,
            'subscription_expired_at' => $user->subscription_expired_at,
            'images' => [
                'avatar' => empty($user->getFirstMediaUrl('avatar')) ?
                    config('samandoon.storage_path') . config('samandoon.default.avatar') :
                    config('samandoon.storage_path') . str_replace(config('samandoon.storage_path_replace'), '', $user->getFirstMediaUrl('avatar')),
                'avatar_thumb' => empty($user->getFirstMediaUrl('avatar')) ?
                    config('samandoon.storage_path') . config('samandoon.default.avatar_thumb') :
                    config('samandoon.storage_path') . str_replace(config('samandoon.storage_path_replace'), '', $user->getFirstMedia('avatar')->getUrl('thumb')),
            ],
            'stats' => [
                // counts
                // watch out for max function nesting if you are eager loading this relations
                'followings_count' => $user->followings->count(),
                'followers_count' => $user->followers->count(),
                'content_count' => $user->contents->count(),
                // when you are in another users profile it show if you are {x}ed that user
                'followed_by_me' => is_null($currentUser) ? false : $user->isFollowedBy($currentUser->id),
                'following_me' => is_null($currentUser) ? false : $user->isFollowing($currentUser->id, User::class),
            ],
            'social_activity_tendency' => [
                'subject_count' => $this->prepareSubjectCount($user->subjectCategoryCount()),
            ],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    /**
     * @param string $phone
     */
    private function obscurePhone(string $phone)
    {
        return substr_replace($phone, '***', 7, 3);
    }

    /**
     * @param User $user
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer());
    }

    private function prepareSubjectCount(array $subjectCategoryCount)
    {
        $subjectsAndCounts = [];
        foreach ($subjectCategoryCount as $key => $value) {
            $temp = [
                'subject' => $key,
                'count' => $value,
            ];
            array_push($subjectsAndCounts, $temp);
        }
        return $subjectsAndCounts;
    }
}
