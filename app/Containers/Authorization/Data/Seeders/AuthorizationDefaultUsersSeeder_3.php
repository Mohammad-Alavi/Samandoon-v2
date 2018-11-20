<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Containers\User\Actions\UpdateUserPasswordSubAction;
use App\Containers\User\Tasks\CreateUserByEmailTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder {

    /**
     * @var CreateUserByEmailTask
     */
    private $createUserByEmailTask;

    /**
     * @var UpdateUserPasswordSubAction
     */
    private $updateUserPasswordSubAction;

    /**
     * @var FindRoleTask
     */
    private $findRoleTask;

    /**
     * AuthorizationDefaultUsersSeeder_3 constructor.
     *
     * @param CreateUserByEmailTask       $createUserByEmailTask
     * @param UpdateUserPasswordSubAction $updateUserPasswordSubAction
     * @param FindRoleTask                $findRoleTask
     */
    public function __construct(CreateUserByEmailTask $createUserByEmailTask,
                                UpdateUserPasswordSubAction $updateUserPasswordSubAction,
                                FindRoleTask $findRoleTask) {
        $this->createUserByEmailTask = $createUserByEmailTask;
        $this->updateUserPasswordSubAction = $updateUserPasswordSubAction;
        $this->findRoleTask = $findRoleTask;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
        |--------------------------------------------------------------------------
        | Admin user
        |--------------------------------------------------------------------------
        |
        */

        //  Create the admin
        $admin = $this->createUserByEmailTask->run(
            false,
            'admin@admin.com'
        );

        //  Set password to admin's account
        $this->updateUserPasswordSubAction->run(
            $admin->id,
            'admin'
        );

        //  Assign 'admin' Role to it
        $adminRole = $this->findRoleTask->run('admin');
        $admin->assignRole(
            $adminRole
        );
    }
}
