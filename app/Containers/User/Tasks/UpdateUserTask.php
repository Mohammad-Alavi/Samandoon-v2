<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Vinkla\Hashids\Facades\Hashids;

class UpdateUserTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UpdateUserTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param array  $userData
     * @param string $userId
     *
     * @return User
     * @throws InternalErrorException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws Exception
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(array $userData, string $userId): User {
        if (empty($userData)) {
            throw new UpdateResourceFailedException('Inputs are empty');
        }

        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = $this->repository->update($userData, $userId);

            // associate avatar image to user if it exist
            if (array_key_exists('avatar', $userData)) {
                $user->addMediaFromRequest('avatar')
                    ->usingFileName(md5((Request::file('avatar')->getClientOriginalName() . Carbon::now()->toTimeString())) . '.' . Request::file('avatar')->getClientOriginalExtension())
                    ->toMediaCollection('avatar');
            }
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            throw new NotFoundException('User Not Found');
        } catch (Exception $exception) {
            DB::rollBack();
            throw new InternalErrorException($exception);
        }
        DB::commit();

        return $user;
    }

}
