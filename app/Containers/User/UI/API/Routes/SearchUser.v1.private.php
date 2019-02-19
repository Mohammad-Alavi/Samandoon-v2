<?php

/**
 * @apiGroup           Search
 * @apiName            searchUser
 *
 * @api                {GET} /v1/search/user?q=همزا Search User
 * @apiDescription     Find Users by their nickname and username
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             UserSuccessPaginatedResponse
 *
 */

/** @var Route $router */
$router->get('search/user', [
    'as' => 'api_user_search_user',
    'uses'  => 'Controller@searchUser',
    'middleware' => [
      'auth:api',
    ],
]);
