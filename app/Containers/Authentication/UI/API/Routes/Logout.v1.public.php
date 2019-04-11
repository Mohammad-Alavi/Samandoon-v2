<?php
/**
 * @apiGroup           OAuth2
 * @apiName            Logout
 * @api                {DELETE} /v1/logout
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {string="android", "ios"} device_type
 * @apiParam           {string} token
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
{
  "message": "Token revoked successfully."
}
 */

/** @var Route $router */
$router->delete('logout', [
    'as' => 'api_authentication_logout',
    'uses'  => 'Controller@logout',
    'middleware' => [
        'auth:api',
    ],
]);

