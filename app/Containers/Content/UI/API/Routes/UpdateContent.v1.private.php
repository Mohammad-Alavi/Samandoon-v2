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
 * @apiParam           {array=article,repost,link} [addon] example: addon[article => true, repost => true]
 * @apiParam           {array} [article] article[title => title here, text => text here]
 * @apiParam           {array} [link] link[link_url => https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string]
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
