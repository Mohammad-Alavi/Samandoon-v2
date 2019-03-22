<?php

/**
 * @apiGroup           Like/Unlike
 * @apiName            unlikeComment
 *
 * @api                {POST} /v1/comment/:comment_id/unlike Unlike Comment
 * @apiDescription     Unlike the given Comment
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             CommentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('comment/{comment_id}/unlike', [
    'as' => 'api_comment_unlike_comment',
    'uses'  => 'Controller@unlikeComment',
    'middleware' => [
      'auth:api',
    ],
]);
