<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
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
     * @param string $id
     * @return User
     * @throws NotFoundException
     */
    public function findById(string $id): User {
        $user = $this->findByField('id', $id)->first();
        if ($user == null)
            throw new NotFoundException();
        else
            return $user;
    }

    /**
     * @param string $phone
     * @return User
     * @throws NotFoundException
     */
    public function findByPhone(string $phone): User {
        $user = $this->findByField('phone', $phone)->first();
        if ($user == null)
            throw new NotFoundException();
        else
            return $user;
    }

    /**
     * @param string $email
     * @return User
     * @throws NotFoundException
     */
    public function findByEmail(string $email): User {
        $user = $this->findByField('email', $email)->first();
        if ($user == null)
            throw new NotFoundException();
        else
            return $user;
    }

}
