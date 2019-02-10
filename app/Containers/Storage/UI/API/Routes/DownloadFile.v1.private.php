<?php

/**
 * @apiGroup           Storage
 * @apiName            downloadFile
 *
 * @api                {GET} /v1/storage/:id/:resource_name Download File
 * @apiDescription     Download a file from server's public folder
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 */

/** @var Route $router */
$router->get('storage/{id}/{resource_name}', [
    'as' => 'api_storage_download_file',
    'uses'  => 'Controller@downloadFile',
//    'middleware' => [
//      'auth:api',
//    ],
]);
