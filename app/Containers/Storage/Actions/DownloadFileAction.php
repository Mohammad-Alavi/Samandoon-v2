<?php

namespace App\Containers\Storage\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class DownloadFileAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $file = Apiato::call('Storage@DownloadFileTask', [$transporter]);
        return $file;
    }
}
