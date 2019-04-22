<?php

/**
 * @apiGroup           Search
 * @apiName            searchTag
 *
 * @api                {GET} /v1/search/tag?q=ووته&tag_type=content Search Tag
 * @apiDescription     Search the Tags and return the resault | 
 *                     Allowed Tag Types: content, subject
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             TagSuccessPaginatedResponse
 *
 */

/** @var Route $router */
$router->get('search/tag', [
    'as' => 'api_tag_search_tag',
    'uses' => 'Controller@searchTag',
    'middleware' => [
        'auth:api',
    ],
]);
