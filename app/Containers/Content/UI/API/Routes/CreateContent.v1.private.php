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
 * @apiParam           {array=article,repost,link} addon =article=>true example: addon[article => true, repost => true]
 * @apiParam           {array} article article[title => title here, text => text here]
 * @apiParam           {array} repost repost[referenced_content_id => reloj65plp4v8ndy]
 * @apiParam           {array} link link[link_url => https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string]
 *
 * @apiUse             ContentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('content', [
    'as' => 'api_content_create_content',
    'uses'  => 'Controller@createContent',
    'middleware' => [
      'auth:api',
    ],
]);
