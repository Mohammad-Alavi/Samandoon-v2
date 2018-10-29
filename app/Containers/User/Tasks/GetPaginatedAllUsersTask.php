<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\AdminsCriteria;
use App\Containers\User\Data\Criterias\ClientsCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class GetPaginatedAllUsersTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * GetPaginatedAllUsersTask constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function run() : LengthAwarePaginator{
        return $this->repository->paginate();
    }
/*
 *   UnTested methods  (MosleM)
 *
    public function clients() {
        $this->repository->pushCriteria(new ClientsCriteria());
    }

    public function admins() {
        $this->repository->pushCriteria(new AdminsCriteria());
    }

    public function ordered() {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function withRole($roles) {
        $this->repository->pushCriteria(new RoleCriteria($roles));
    }
*/

}
