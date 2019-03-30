<?php

namespace App\Containers\Storage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DownloadConversionFilesAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $file = Apiato::call('Storage@DownloadConversionFilesTask', [$transporter]);
        return $file;
    }
}
