<?php

/**
 * @apiGroup           Comment
 * @apiName            deleteComment
 *
 * @api                {DELETE} /v1/user/:id/content/:id/comment/:id Delete Comment
 * @apiDescription     Delete a Comment by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated|Owner
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->delete('user/{id}/comment/{comment_id}', [
    'as' => 'api_comment_delete_comment',
    'uses'  => 'Controller@deleteComment',
    'middleware' => [
      'auth:api',
    ],
]);
