<?php

/**
 * @apiGroup           Comment
 * @apiName            getComment
 *
 * @api                {GET} /v1/comment/:id Find Comment by ID
 * @apiDescription     Find a comment by it's ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiUse             CommentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('comment/{id}', [
    'as' => 'api_comment_get_comment',
    'uses'  => 'Controller@getComment',
//    'middleware' => [
//      'auth:api',
//    ],
]);
