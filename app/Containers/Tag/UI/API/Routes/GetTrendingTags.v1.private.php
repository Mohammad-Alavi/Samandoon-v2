<?php

/**
 * @apiGroup           Tag
 * @apiName            getTrendingTags
 *
 * @api                {GET} /v1/trending/tags Get Trending Tags
 * @apiDescription     Get the top 10 Trending tags in the specified period
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String=day,week} period get the trending tags in day or week
 * @apiParam           {String=content,subject} tag_type get the trending tags of a specific tag_type
 *
 * @apiUse             TagSuccessPaginatedResponse
 */

/** @var Route $router */
$router->get('trending/tags', [
    'as' => 'api_tag_get_trending_tags',
    'uses'  => 'Controller@getTrendingTags',
    'middleware' => [
      'auth:api',
    ],
]);
