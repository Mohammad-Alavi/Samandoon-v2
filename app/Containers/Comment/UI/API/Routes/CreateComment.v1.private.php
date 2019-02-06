<?php

/**
 * @apiGroup           Comment
 * @apiName            createComment
 *
 * @api                {POST} /v1/content/:content_id/comment Create Comment
 * @apiDescription     Create a Comment
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authorized
 *
 * @apiParam           {String} body Comment text
 * @apiParam           {String} [parent_id] Parent id of the comment
 *
 * @apiUse             CommentSuccessSingleResponse
 */

/** @var Route $router */
$router->post('content/{content_id}/comment', [
    'as' => 'api_comment_create_comment',
    'uses'  => 'Controller@createComment',
    'middleware' => [
      'auth:api',
    ],
]);
