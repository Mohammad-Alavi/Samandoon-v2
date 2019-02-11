<?php

/**
 * @apiGroup           Follow
 * @apiName            follow
 *
 * @api                {POST} /v1/user/follow/:id Follow
 * @apiDescription     Follow a User by it's ID - "followers_count" = the followers count of the followed User
 *                     - "is_following" = is the authenticated User following the given User? (user of the given ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "followers_count": 1,
    "is_following": true
}
 */

/** @var Route $router */
$router->post('user/follow/{id}', [
    'as' => 'api_user_follow',
    'uses'  => 'Controller@follow',
    'middleware' => [
      'auth:api',
    ],
]);
