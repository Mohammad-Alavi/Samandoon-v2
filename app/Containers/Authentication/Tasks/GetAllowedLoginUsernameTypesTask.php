<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;

class GetAllowedLoginUsernameTypesTask extends Task {

    /**
     * @return array
     */
    public function run(): array {
        $allowedLoginUsernameFields = config(
            'authentication-container.login.allowed_login_username_types',
            ['email']
        );
        return $allowedLoginUsernameFields;
    }
}
