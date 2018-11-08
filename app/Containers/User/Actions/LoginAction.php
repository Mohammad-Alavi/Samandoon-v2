<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Actions\Action;

class LoginAction extends Action {

    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function run(LoginRequest $request) {
        return Apiato::call('Authentication@ProxyApiLoginByOneTimePasswordSubAction', [$request]);
    }
}
