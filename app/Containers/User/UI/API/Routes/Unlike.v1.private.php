<?php

/**
 * @apiGroup           Like
 * @apiName            unlike
 *
 * @api                {POST} /v1/user/unlike/:content_id Unlike
 * @apiDescription     Unlike the given Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             LikeSuccessResponse
 */

/** @var Route $router */
$router->post('user/unlike/{content_id}', [
    'as' => 'api_user_unlike',
    'uses'  => 'Controller@unlike',
    'middleware' => [
      'auth:api',
    ],
]);
