<?php

/**
 * @apiGroup           Content
 * @apiName            updateContent
 *
 * @api                {PUT} /v1/user/:id/content/:content_id Endpoint title here..
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
$router->put('user/{id}/content/{content_id}', [
    'as' => 'api_content_update_content',
    'uses'  => 'Controller@updateContent',
    'middleware' => [
      'auth:api',
    ],
]);
