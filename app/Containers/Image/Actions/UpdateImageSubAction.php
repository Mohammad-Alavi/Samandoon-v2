<?php

namespace App\Containers\Image\Actions;

use App\Containers\Image\Models\Image;
use App\Containers\Image\Tasks\UpdateImageTask;
use App\Ship\Parents\Actions\SubAction;

class UpdateImageSubAction extends SubAction
{
    protected $updateImageTask;

    /**
     * UpdateImageSubAction constructor.
     *
     * @param UpdateImageTask $updateImageTask
     */
    public function __construct(UpdateImageTask $updateImageTask)
    {
        $this->updateImageTask = $updateImageTask;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return Image
     */
    public function run(array $data, $id): Image
    {
        $image = $this->updateImageTask->run($id, $data);

        return $image;
    }
}
