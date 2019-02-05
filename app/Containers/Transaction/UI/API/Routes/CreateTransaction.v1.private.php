<?php

/**
 * @apiGroup           Transaction
 * @apiName            createTransaction
 *
 * @api                {POST} /v1/transactions Endpoint title here..
 * @apiDescription     Endpoint description here..
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
$router->post('transaction', [
    'as' => 'api_transaction_create_transaction',
    'uses'  => 'Controller@createTransaction',
    'middleware' => [
      'auth:api',
    ],
]);
