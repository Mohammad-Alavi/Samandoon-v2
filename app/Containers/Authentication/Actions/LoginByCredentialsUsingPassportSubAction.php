<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\SubAction;

class LoginByCredentialsUsingPassportSubAction extends SubAction {

    /**
     * @param array $requestData
     * @return array
     */
    public function run(array $requestData): array {
        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie'   => $refreshCookie,
        ];
    }
}
