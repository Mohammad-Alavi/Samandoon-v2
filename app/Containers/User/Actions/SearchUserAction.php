<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class SearchUserAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $sanitizedData = $transporter->sanitizeInput([
            'q',
        ]);

        return Apiato::call('User@SearchuserTask', [$sanitizedData, $transporter->limit]);
    }
}
