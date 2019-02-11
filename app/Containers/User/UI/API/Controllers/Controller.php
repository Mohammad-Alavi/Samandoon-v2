<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\NoReasonFailureException;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\FollowRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Http\JsonResponse;


class Controller extends ApiController
{

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $result = Apiato::call('User@RegisterAction', [$request]);
        if ($result) {
            return $this->noContent();
        }
        else {
            throw new NoReasonFailureException();
        }
    }


    /**
     * @param LoginRequest $request
     *
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $data = Apiato::call('Authentication@LoginAction', [$request]);

        return $data;
    }


    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = Apiato::call('User@CreateAdminByEmailAndPasswordSubAction', [new DataTransporter($request)]);

        return $this->transform($admin, UserTransformer::class);
    }


    public function updateUser(UpdateUserRequest $request)
    {
        $user = Apiato::call('User@UpdateUserAction', [new DataTransporter($request)]);

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }


    public function deleteUser(DeleteUserRequest $request)
    {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);

        return $this->noContent();
    }


    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllUsersAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function findUserById(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }


    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request)
    {
        $user = Apiato::call('User@GetAuthenticatedUserSubAction');

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    /**
     * @param FollowRequest $request
     *
     * @return mixed
     */
    public function follow(FollowRequest $request)
    {
        $result = Apiato::call('User@FollowAction', [new DataTransporter($request)]);

        return new JsonResponse([
            'followers_count' => $result['followers_count'],
            'is_following' => $result['is_following']
        ], 200);
    }
}
