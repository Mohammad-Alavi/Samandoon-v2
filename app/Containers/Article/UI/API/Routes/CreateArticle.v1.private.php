<?php

/**
 * @apiGroup           Article
 * @apiName            createArticle
 *
 * @api                {POST} /v1/article Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('article', [
    'as' => 'api_article_create_article',
    'uses'  => 'Controller@createArticle',
    'middleware' => [
      'auth:api',
    ],
]);
