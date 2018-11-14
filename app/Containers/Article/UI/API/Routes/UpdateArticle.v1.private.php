<?php

/**
 * @apiGroup           Article
 * @apiName            updateArticle
 *
 * @api                {PUT} /v1/article/:id Endpoint title here..
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
$router->put('article/{id}', [
    'as' => 'api_article_update_article',
    'uses'  => 'Controller@updateArticle',
    'middleware' => [
      'auth:api',
    ],
]);
