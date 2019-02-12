<?php

/**
 * @apiGroup           User
 * @apiName            getUserFeed
 *
 * @api                {GET} /v1/feed Get User Feed
 * @apiDescription     Get User Content Feed
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('feed', [
    'as' => 'api_user_get_user_feed',
    'uses'  => 'Controller@getUserFeed',
    'middleware' => [
      'auth:api',
    ],
]);
