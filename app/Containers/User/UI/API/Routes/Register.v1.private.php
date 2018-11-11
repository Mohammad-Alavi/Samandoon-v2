<?php

/**
 * @apiGroup           Users
 * @apiName            register
 * @api                {post} /v1/register Register User
 * @apiDescription     Create a user by phone or email and password or without password (one time password will be sent to user)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  phone
 *
 * @apiUse             GeneratePasswordSuccessResponse
 */

$router->post('register', [
    'as' => 'api_register',
    'uses'  => 'Controller@register',
]);
