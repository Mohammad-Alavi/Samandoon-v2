<?php

/**
 * @apiGroup           Content
 * @apiName            createContent
 *
 * @api                {POST} /v1/user/:id/content Create Content
 * @apiDescription     Create Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authorized
 *
 * @apiParam           {array}  article [title => title here, text => text here]
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
