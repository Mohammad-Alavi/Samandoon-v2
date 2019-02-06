<?php

/**
 * @apiGroup           Content
 * @apiName            getContent
 *
 * @api                {GET} /v1/user/:id/content/:content_id Get Content
 * @apiDescription     Find content by it's ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('content/{content_id}', [
    'as' => 'api_content_get_content',
    'uses'  => 'Controller@getContent',
//    'middleware' => [
//      'auth:api',
//    ],
]);
