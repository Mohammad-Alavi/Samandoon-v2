<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllUsersAction extends Action {

    /**
     * @return LengthAwarePaginator
     */
    public function run(): LengthAwarePaginator {
        return Apiato::call('User@GetPaginatedAllUsersTask',
            [],
            [
                'addRequestCriteria',
                'ordered',
            ]
        );
    }
}
