<?php

/**
 * @apiGroup           Content
 * @apiName            getAllContents
 *
 * @api                {GET} /v1/content Get All Contents
 * @apiDescription     Get All Contents
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('content', [
    'as' => 'api_content_get_all_contents',
    'uses'  => 'Controller@getAllContents',
    'middleware' => [
      'auth:api',
    ],
]);
