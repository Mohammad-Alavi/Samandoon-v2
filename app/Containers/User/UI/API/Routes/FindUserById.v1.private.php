<?php

/**
 * @apiGroup           Users
 * @apiName            findUserById
 * @api                {get} /v1/user/:id Find User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('user/{id}', [
    'as' => 'api_user_find_user',
    'uses'       => 'Controller@findUserById',
    'middleware' => [
        'auth:api',
    ],
]);
