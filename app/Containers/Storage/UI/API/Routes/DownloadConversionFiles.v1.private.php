<?php

/**
 * @apiGroup           Storage
 * @apiName            downloadConversionFiles
 *
 * @api                {GET} /v1/storage/:id/conversions/:resource_name Endpoint title here..
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
$router->get('storage/{id}/conversions/{resource_name}', [
    'as' => 'api_storage_download_conversion_files',
    'uses'  => 'Controller@downloadConversionFiles',
//    'middleware' => [
//      'auth:api',
//    ],
]);
