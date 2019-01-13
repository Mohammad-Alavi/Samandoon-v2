<?php

/**
 * @apiGroup           Transaction
 * @apiName            getAllTransactions
 *
 * @api                {GET} /v1/transactions Endpoint title here..
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
$router->get('transaction', [
    'as' => 'api_transaction_get_all_transactions',
    'uses'  => 'Controller@getAllTransactions',
    'middleware' => [
      'auth:api',
    ],
]);
