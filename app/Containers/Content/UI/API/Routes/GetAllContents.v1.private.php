<?php

/**
 * @apiGroup           Content
 * @apiName            getAllContents
 *
 * @api                {GET} /v1/content Endpoint title here..
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
$router->get('content', [
    'as' => 'api_content_get_all_contents',
    'uses'  => 'Controller@getAllContents',
    'middleware' => [
      'auth:api',
    ],
]);
