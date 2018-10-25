<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\GeneratePasswordRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\GeneratePasswordTransformer;
use App\Containers\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\GeneratePasswordRequest $request
     *
     * @return  mixed
     */
    public function generatePassword(GeneratePasswordRequest $request)
    {
        $password = Apiato::call('User@GeneratePasswordAction', [$request]);

        return $this->accepted($password);  //  TODO: remove it after SMS system run
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = Apiato::call('User@CreateAdminAction', [new DataTransporter($request)]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = Apiato::call('User@UpdateUserAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);

        return $this->noContent();
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllUsersAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUserById(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param GetAuthenticatedUserRequest $request
     *
     * @return mixed
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request)
    {
        $user = Apiato::call('User@GetAuthenticatedUserSubAction');

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

}
