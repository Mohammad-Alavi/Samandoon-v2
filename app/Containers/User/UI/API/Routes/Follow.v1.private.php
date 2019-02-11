<?php

/**
 * @apiGroup           Follow
 * @apiName            follow
 *
 * @api                {POST} /v1/user/follow/:id Follow
 * @apiDescription     Follow a User by it's ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             FollowSuccessResponse
 */

/** @var Route $router */
$router->post('user/follow/{id}', [
    'as' => 'api_user_follow',
    'uses'  => 'Controller@follow',
    'middleware' => [
      'auth:api',
    ],
]);
