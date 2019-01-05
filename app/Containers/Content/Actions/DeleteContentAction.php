<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeleteContentAction
 *
 * @package App\Containers\Content\Actions
 */
class DeleteContentAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        return Apiato::call('Content@DeleteContentTask', [$transporter->content_id]);
    }
}
