<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\GeneratePasswordRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;


class Controller extends ApiController {

    public function generatePassword(GeneratePasswordRequest $request) {
        $user = Apiato::call('User@GeneratePasswordAction', [$request]);

        return $this->noContent();
    }


    public function login(LoginRequest $request) {
        $data = Apiato::call('Authentication@ProxyApiLoginAction', [$request]);

        return $data;
    }


    public function createAdmin(CreateAdminRequest $request) {
        $admin = Apiato::call('User@CreateAdminAction', [new DataTransporter($request)]);

        return $this->transform($admin, UserTransformer::class);
    }


    public function updateUser(UpdateUserRequest $request) {
        $user = Apiato::call('User@UpdateUserAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }


    public function deleteUser(DeleteUserRequest $request) {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);

        return $this->noContent();
    }


    public function getAllUsers(GetAllUsersRequest $request) {
        $users = Apiato::call('User@GetAllUsersAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function getAllClients(GetAllUsersRequest $request) {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function getAllAdmins(GetAllUsersRequest $request) {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }


    public function findUserById(FindUserByIdRequest $request) {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }


    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request) {
        $user = Apiato::call('User@GetAuthenticatedUserSubAction');

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

}
