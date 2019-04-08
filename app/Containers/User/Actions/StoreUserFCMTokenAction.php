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
        $data = $transporter->sanitizeInput([
            'device_type',
            'token'
        ]);

        // add some data
        $data['user_id'] = Auth::id();
        $data['user_token'] = Auth::user()->token()->id;

        $result = Apiato::call('User@StoreUserFCMTokenTask', [$data]);
        return $result;
    }
}
