<?php

namespace App\Containers\Content\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetAllContentsAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $contents = Apiato::call('Content@GetAllContentsTask', [], ['addRequestCriteria']);

        return $contents;
    }
}
