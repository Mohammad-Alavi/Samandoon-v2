<?php

namespace App\Containers\Link\Actions;

use App\Containers\Link\Models\Link;
use App\Containers\Link\Tasks\UpdateLinkTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class UpdateLinkSubAction
 *
 * @package App\Containers\Link\Actions
 */
class UpdateLinkSubAction extends SubAction
{

    protected $updateLinkTask;

    /**
     * UpdateLinkSubAction constructor.
     *
     * @param UpdateLinkTask $updateLinkTask
     */
    public function __construct(UpdateLinkTask $updateLinkTask)
    {
        $this->updateLinkTask = $updateLinkTask;
    }

    /**
     * @param array $data
     *
     * @param       $id
     *
     * @return Link
     */
    public function run(array $data, $content): Link
    {
        $article = $this->updateLinkTask->run($content->link->id, $data);

        return $article;
    }
}
