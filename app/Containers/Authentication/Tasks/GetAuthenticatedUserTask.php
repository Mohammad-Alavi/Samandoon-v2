<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserTask extends Task
{

    /**
     * @return  \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function run()
    {
        return Auth::user();
    }

}
