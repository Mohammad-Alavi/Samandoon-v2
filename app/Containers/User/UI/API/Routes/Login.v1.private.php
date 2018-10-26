<?php

/**
 * @apiGroup           Users
 * @apiName            login
 * @api                {POST} /v1/login Login user
 * @apiDescription     Login user using username and password
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  phone
 * @apiParam           {String}  password
 *
 * @apiUse             GeneratePasswordSuccessResponse
 */

$router->post('login', [
    'as' => 'api_user_login',
    'uses'  => 'Controller@login'
]);
