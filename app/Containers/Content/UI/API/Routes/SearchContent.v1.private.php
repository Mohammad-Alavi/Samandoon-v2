<?php


/**
 * @apiGroup           Search
 * @apiName            searchContent
 *
 * @api                {GET} /v1/search/content?q=ووته Search Content
 * @apiDescription     Search the Content text and return the resault
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiParam           {string} [tag] this and tag_type parameter should be send together
 * @apiParam           {string=subject,content} [tag_type] this and tag parameter should be send together

 * @apiUse             ContentSuccessSingleResponse
 *
 */
/** @var Route $router */
$router->get('search/content', [
    'as' => 'api_content_search_content',
    'uses'  => 'Controller@searchContent',
    'middleware' => [
      'auth:api',
    ],
]);
