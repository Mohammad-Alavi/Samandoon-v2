<?php

namespace App\Containers\Storage\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Storage\UI\API\Requests\DeleteFileRequest;
use App\Containers\Storage\UI\API\Requests\DownloadFileRequest;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    /**
     * @param DownloadFileRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(DownloadFileRequest $request)
    {
        $file = Apiato::call('Storage@DownloadFileAction', [new DataTransporter($request)]);
        return response()->download($file);
    }

    /**
     * @param DeleteFileRequest $request
     *
     * @return mixed
     */
    public function deleteFile(deleteFileRequest $request)
    {
        Apiato::call('Storage@DeleteFileAction', [new DataTransporter($request)]);
        return $this->noContent();
    }
}
