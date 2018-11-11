<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\UsernameTypeNotAcceptedException;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Actions\SubAction;

class GetLoginUsernameFieldSubAction extends SubAction {

    /**
     * @param LoginRequest $request
     * @return string
     */
    public function run(LoginRequest $request): string {
        $prefix = config('authentication-container.login.prefix', '');
        $allowedLoginUsernameFields = Apiato::call('Authentication@GetAllowedLoginUsernameTypesTask');

        $loginUsername = null;
        $loginAttribute = null;

        foreach ($allowedLoginUsernameFields as $field) {
            $fieldName = $prefix . $field;
            $loginUsername = $request->getInputByKey($fieldName);
            $loginAttribute = $field;

            if ($loginUsername !== null) {
                break;
            }
        }

        if ($loginUsername == null)
            throw new UsernameTypeNotAcceptedException();
        else
            return $loginAttribute;

    }
}
