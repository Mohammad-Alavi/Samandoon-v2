<?php

/**
 * @apiGroup           Link
 * @apiName            getLinkOGData
 *
 * @api                {GET} /v1/content/link/og Get Link OG Data
 * @apiDescription     Get the given link open graph data
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {string} url http://www.samandoon.ir this should be a complete url with http/s
 * @apiParam           {boolean} get_all_meta_data 0 or 1 | 0 = false and 1 = true
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('content/link/og', [
    'as' => 'api_link_get_link_o_g_data',
    'uses'  => 'Controller@getLinkOGData',
//    'middleware' => [
//      'auth:api',
//    ],
]);
