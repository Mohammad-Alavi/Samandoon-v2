<?php

/**
 * @apiGroup           Content
 * @apiName            createContent
 *
 * @api                {POST} /v1/user/:id/content Endpoint title here..
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
$router->post('user/{id}/content', [
    'as' => 'api_content_create_content',
    'uses'  => 'Controller@createContent',
    'middleware' => [
      'auth:api',
    ],
]);
