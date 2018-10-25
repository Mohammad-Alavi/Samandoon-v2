<?php

/**
 * @apiGroup           Users
 * @apiName            generatePassword
 * @api                {get} /v1/password Generate password
 * @apiDescription     Generate and send a new password to user
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  phone
 *
 * @apiUse             GeneratePasswordSuccessResponse
 */

$router->get('password', [
    'as' => 'api_user_generate_password',
    'uses'  => 'Controller@generatePassword'
]);
