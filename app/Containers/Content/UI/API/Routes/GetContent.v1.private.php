<?php

/**
 * @apiGroup           Content
 * @apiName            getContent
 *
 * @api                {GET} /v1/user/:id/content/:content_id Endpoint title here..
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
$router->get('user/{id}/content/{content_id}', [
    'as' => 'api_content_get_content',
    'uses'  => 'Controller@getContent',
    'middleware' => [
      'auth:api',
    ],
]);
