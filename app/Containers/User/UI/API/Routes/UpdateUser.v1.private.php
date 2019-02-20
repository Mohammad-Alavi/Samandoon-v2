<?php

/**
 * @apiGroup           Users
 * @apiName            updateUser
 * @api                {put} /v1/user/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  [first_name] min:2|max:50
 * @apiParam           {String}  [last_name] min:2|max:50
 * @apiParam           {String}  [nick_name] min:2|max:50
 * @apiParam           {String}  [email] email|unique:users,email
 * @apiParam           {String}  [username] min:5|max:32|regex:/^[a-zA-Z](?:_?[a-zA-Z0-9]+)*$/|unique:users,username
 * @apiParam           {String}  [phone] size:13|regex:/(\+989)[0-9]/
 * @apiParam           {String="male,female,unspecified"}  [gender]
 * @apiParam           {date}  [birth] date_format:YmdHiT'
 * @apiParam           {image}  [avatar]
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->put('user/{id}', [
    'as' => 'api_user_update_user',
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'auth:api',
    ],
]);
