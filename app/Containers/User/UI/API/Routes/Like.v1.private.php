<?php

/**
 * @apiGroup           Like
 * @apiName            like
 *
 * @api                {POST} /v1/user/like/:content_id Like
 * @apiDescription     Like the given Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "msg": "User (3mjzyg5dp5a0vwp6) liked Content (kjeonp5eordqzvb8).",
    "like_count": 1, // this is the current like count of the liked target e.g. Content
    "is_liked": true // is current User liked the given Content ID?
}
 */

/** @var Route $router */
$router->post('user/like/{content_id}', [
    'as' => 'api_user_like',
    'uses'  => 'Controller@like',
    'middleware' => [
      'auth:api',
    ],
]);
