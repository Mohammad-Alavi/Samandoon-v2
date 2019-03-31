<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetFollowersAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     */
    public function run(DataTransporter $dataTransporter)
    {
        $user = Apiato::call('User@FindUserbyIdTask', [$dataTransporter->id]);

        return Apiato::call('User@GetFollowersTask', [$user, $dataTransporter->limit]);
    }
}
