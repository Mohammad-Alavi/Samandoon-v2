<?php

namespace App\Containers\Link\Actions;

use App\Containers\Link\Tasks\DeleteLinkTask;
use App\Ship\Parents\Actions\SubAction;

class DeleteLinkSubAction extends SubAction
{
    /** @var DeleteLinkTask $deleteLinkTask */
    protected $deleteLinkTask;

    public function __construct(DeleteLinkTask $deleteLinkTask)
    {
        $this->deleteLinkTask = $deleteLinkTask;
    }

    public function run($id)
    {
        return $this->deleteLinkTask->run($id);
    }
}
