<?php

/**
 * @apiGroup           Like/Unlike
 * @apiName            likeComment
 *
 * @api                {POST} /v1/comment/:comment_id/like Like Comment
 * @apiDescription     Like the given Comment
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             CommentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('comment/{comment_id}/like', [
    'as' => 'api_comment_like_comment',
    'uses'  => 'Controller@likeComment',
    'middleware' => [
      'auth:api',
    ],
]);
