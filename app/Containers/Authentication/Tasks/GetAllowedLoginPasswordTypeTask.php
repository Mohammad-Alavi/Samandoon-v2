<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;

class GetAllowedLoginPasswordTypeTask extends Task {

    /**
     * @return string
     */
    public function run(): string {
        $allowedLoginPasswordFields = config(
            'authentication-container.login.allowed_login_password_type',
            'password'
        );
        return $allowedLoginPasswordFields;
    }
}
