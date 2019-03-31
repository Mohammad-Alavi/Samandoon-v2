<?php

/**
 * @apiGroup           Follow
 * @apiName            getFollowers
 *
 * @api                {GET} /v1/user/{id}/followers?limit=10 Get Followers
 * @apiDescription     Get the followers of the authenticated user
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             UserSuccessPaginatedResponse
 */

/** @var Route $router */
$router->get('user/{id}/followers', [
    'as' => 'api_user_get_followers',
    'uses'  => 'Controller@getFollowers',
//    'middleware' => [
//      'auth:api',
//    ],
]);
