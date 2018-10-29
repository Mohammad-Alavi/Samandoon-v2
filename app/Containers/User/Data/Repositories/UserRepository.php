<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Models\User;
use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository {

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name' => 'like',
        'last_name'  => 'like',
        'id'         => '=',
        'email'      => '=',
        'phone'      => '=',
        'created_at' => 'like',
    ];

    /**
     * @param string $phone
     * @return User|null
     */
    public function findByPhone(string $phone): ?User {
        return $this->findByField('phone', $phone)->first();
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User {
        return $this->findByField('email', $email)->first();
    }

}
