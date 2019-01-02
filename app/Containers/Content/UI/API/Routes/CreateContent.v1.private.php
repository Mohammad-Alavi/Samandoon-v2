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
 * @apiParam           {array} article article[title => title here, text => text here]
 * @apiParam           {array} addon =[article=>true] addon[addonname => true, addonname2 => false]
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('user/{id}/content', [
    'as' => 'api_content_create_content',
    'uses'  => 'Controller@createContent',
    'middleware' => [
      'auth:api',
    ],
]);
