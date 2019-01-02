<?php

namespace App\Containers\Link\Actions;

use App\Containers\Link\Models\Link;
use App\Containers\Link\Tasks\UpdateLinkTask;
use App\Ship\Parents\Actions\SubAction;

class UpdateLinkSubAction extends SubAction
{

    protected $updateLinkTask;

    public function __construct(UpdateLinkTask $updateLinkTask)
    {
        $this->updateLinkTask = $updateLinkTask;
    }

    /**
     * @param array $data
     *
     * @param $id
     * @return Link
     */
    public function run(array $data, $id): Link
    {

        $article = $this->updateLinkTask->run($id, $data);

        return $article;
    }
}
