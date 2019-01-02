<?php

/**
 * @apiGroup           Content
 * @apiName            updateContent
 *
 * @api                {PUT} /v1/user/:id/content/:content_id Update Content
 * @apiDescription     Update Content
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated|Owner
 *
 * @apiParam           [array] article article[title => title here, text => text here]
 * @apiParam           {array} addon =[article=>true] addon[addonname => true, addonname2 => false]
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->put('user/{id}/content/{content_id}', [
    'as' => 'api_content_update_content',
    'uses'  => 'Controller@updateContent',
    'middleware' => [
      'auth:api',
    ],
]);
