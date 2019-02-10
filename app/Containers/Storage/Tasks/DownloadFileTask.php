<?php

namespace App\Containers\Storage\Tasks;

use App\Ship\Parents\Tasks\Task;

class DownloadFileTask extends Task
{
    public function run($data)
    {
        $file =  public_path() . '/storage/' . $data->id . '/' . $data->resource_name;
        return $file;
    }
}
