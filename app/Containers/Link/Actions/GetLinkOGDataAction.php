<?php

namespace App\Containers\Link\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetLinkOGDataAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $og_data = Apiato::call('Link@GetLinkOGDataTask', [$transporter->url, $transporter->get_all_meta_data]);
        return $og_data;
    }
}
