<?php

namespace App\Containers\Link\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Link\UI\API\Requests\GetLinkOGDataRequest;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    public function getLinkOGData(GetLinkOGDataRequest $request)
    {
        $og_data = Apiato::call('Link@GetLinkOGDataAction', [new DataTransporter($request)]);
        return $og_data;
    }
}
