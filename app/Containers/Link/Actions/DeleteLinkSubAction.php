<?php

namespace App\Containers\Link\Actions;

use App\Containers\Link\Tasks\DeleteLinkTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class DeleteLinkSubAction
 *
 * @package App\Containers\Link\Actions
 */
class DeleteLinkSubAction extends SubAction
{
    /** @var DeleteLinkTask $deleteLinkTask */
    protected $deleteLinkTask;

    /**
     * DeleteLinkSubAction constructor.
     *
     * @param DeleteLinkTask $deleteLinkTask
     */
    public function __construct(DeleteLinkTask $deleteLinkTask)
    {
        $this->deleteLinkTask = $deleteLinkTask;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function run($id)
    {
        return $this->deleteLinkTask->run($id);
    }
}
