<?php

/**
 * @apiGroup           Storage
 * @apiName            deleteFile
 *
 * @api                {DELETE} /v1/storage/:id/:resource_name Delete File
 * @apiDescription     Delete the given file from storage
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated|Owner
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 */

/** @var Route $router */
$router->delete('storage/{id}/{resource_name}', [
    'as' => 'api_storage_delete_file',
    'uses'  => 'Controller@deleteFile',
    'middleware' => [
      'auth:api',
    ],
]);
