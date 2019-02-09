<?php

namespace App\Containers\Image\Actions;

use App\Containers\Image\Tasks\DeleteImageTask;
use App\Ship\Parents\Actions\SubAction;

class DeleteImageSubAction extends SubAction
{
    /** @var DeleteImageTask $deleteImageTask */
    protected $deleteImageTask;

    /**
     * DeleteImageSubAction constructor.
     *
     * @param DeleteImageTask $deleteImageTask
     */
    public function __construct(DeleteImageTask $deleteImageTask)
    {
        $this->deleteImageTask = $deleteImageTask;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function run($id)
    {
        return $this->deleteImageTask->run($id);
    }
}
