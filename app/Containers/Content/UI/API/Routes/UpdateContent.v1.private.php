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
 * @apiParam           {json}  [subjects] To delete all subjects send an empty array -> []. To add or update subjects send an array with subject names -> ["environment", "women"]. This subjects will replace the current subjects of Content. e.g. if current subjects are ["health care", "child workers", "social education"] and you send ["environment", "women"], new subjects will be ["environment", "women"].
 * @apiParam           {json}  [tags] To delete all tags send an empty array -> []. To add or update tags send an array with tag names -> ["tag 1", "tag 2"]. This tags will replace the current tags of Content. e.g. if current tags are ["tag 3", "tag 4"] and you send ["tag 1", "tag 2"], new tags will be ["tag 1", "tag 2"].

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
