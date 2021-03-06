<?php

/**
 * @apiGroup           OAuth2
 * @apiName            LoginPasswordGrant
 * @api                {post} /v1/oauth/token Login (Password Grant)
 * @apiDescription     Login Users using their valid username and password. (For First-Party Clients)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  username user phone number or confirmed email address. example: `+989360000000`
 * @apiParam           {String}  password pin-code which is sent to phone or email
 * @apiParam           {String}  client_id
 * @apiParam           {String}  client_secret
 * @apiParam           {String}  grant_type must be `password`
 * @apiParam           {String}  [scope] you can leave it empty
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
  "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
}
 */

// Implementation in the Laravel Passport package
