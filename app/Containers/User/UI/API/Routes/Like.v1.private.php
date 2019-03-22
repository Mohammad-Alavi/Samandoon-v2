<?php

/**
 * @apiGroup           Like/Unlike
 * @apiName            like
 *
 * @api                {POST} /v1/user/like/:content_id Like Content
 * @apiDescription     Like the given Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('user/like/{content_id}', [
    'as' => 'api_user_like',
    'uses'  => 'Controller@like',
    'middleware' => [
      'auth:api',
    ],
]);
