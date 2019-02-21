<?php

/**
 * @apiGroup           Comment
 * @apiName            getAllComments
 *
 * @api                {GET} /v1/content/{content_id}/comment Get All Comments of a Content
 * @apiDescription     Get All Comments of a Content by its Content ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiUse             CommentSuccessSingleResponse
 */

/** @var Route $router */
$router->get('content/{content_id}/comment', [
    'as' => 'api_comment_get_all_comments',
    'uses'  => 'Controller@getAllComments',
//    'middleware' => [
//      'auth:api',
//    ],
]);
