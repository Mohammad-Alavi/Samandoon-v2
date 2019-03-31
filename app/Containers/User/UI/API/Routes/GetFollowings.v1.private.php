<?php

/**
 * @apiGroup           Follow
 * @apiName            getFollowings
 *
 * @api                {GET} /v1/user/{id}/followings?limit=10 Get Followings
 * @apiDescription     Get the followings of the authenticated user
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             UserSuccessPaginatedResponse
 */

/** @var Route $router */
$router->get('user/{id}/followings', [
    'as' => 'api_user_get_followings',
    'uses'  => 'Controller@getFollowings',
//    'middleware' => [
//      'auth:api',
//    ],
]);
