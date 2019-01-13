<?php

/** @var Route $router */
$router->get('transaction/verify', [
    'as'         => 'web_transaction_verify_transaction',
    'uses'       => 'Controller@verifyTransaction',
]);
