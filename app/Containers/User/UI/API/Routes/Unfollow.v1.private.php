<?php

/**
 * @apiGroup           Follow
 * @apiName            unfollow
 *
 * @api                {POST} /v1/user/unfollow/:id Unfollow
 * @apiDescription     Unfollow the user of the given ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "followers_count": 23,
    "is_following": false
}
 */

/** @var Route $router */
$router->post('user/unfollow/{id}', [
    'as' => 'api_user_unfollow',
    'uses'  => 'Controller@unfollow',
    'middleware' => [
      'auth:api',
    ],
]);
