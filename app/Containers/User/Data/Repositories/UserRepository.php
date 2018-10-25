<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository {

    protected $fieldSearchable = [
        'first_name' => 'like',
        'last_name'  => 'like',
        'id'         => '=',
        'email'      => '=',
        'phone'      => '=',
        'created_at' => 'like',
    ];

    public function findByPhone($phone) {
        return $this->findByField('phone', $phone)->first();
    }

    public function findByEmail($email) {
        return $this->findByField('email', $email)->first();
    }

}
