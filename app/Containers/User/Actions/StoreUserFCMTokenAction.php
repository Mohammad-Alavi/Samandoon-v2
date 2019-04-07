<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Auth;

class StoreUserFCMTokenAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $userId = Auth::id();
        $result = Apiato::call('User@StoreUserFCMTokenTask', [$transporter, $userId]);
        return $result;
    }
}
