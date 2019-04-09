<?php

/**
 * @apiGroup           NotificationCenter
 * @apiName            getNotifications
 *
 * @api                {GET} /v1/user/notifications Get user notifications
 * @apiDescription     Get user notifications
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('user/notifications', [
    'as' => 'api_notificationcenter_get_notifications',
    'uses'  => 'Controller@getNotifications',
    'middleware' => [
      'auth:api',
    ],
]);
