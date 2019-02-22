<?php

/**
 * @apiGroup           Content
 * @apiName            getAllContents
 *
 * @api                {GET} /v1/content Get All Contents
 * @apiDescription     Get All Contents
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {string} [tag] this and tag_type parameter should be send together
 * @apiParam           {string=subject,content} [tag_type] this and tag parameter should be send together
 *                     
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('content', [
    'as' => 'api_content_get_all_contents',
    'uses'  => 'Controller@getAllContents',
//    'middleware' => [
//      'auth:api',
//    ],
]);
