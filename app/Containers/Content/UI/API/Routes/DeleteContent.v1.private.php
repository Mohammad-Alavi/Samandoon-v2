<?php

/**
 * @apiGroup           Content
 * @apiName            deleteContent
 *
 * @api                {DELETE} /v1/user/:id/content/:content_id Delete Content
 * @apiDescription     Deletes the given Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated|Owner
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->delete('user/{id}/content/{content_id}', [
    'as' => 'api_content_delete_content',
    'uses'  => 'Controller@deleteContent',
    'middleware' => [
      'auth:api',
    ],
]);
