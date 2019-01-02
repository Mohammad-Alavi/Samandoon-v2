<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetContentAction
 *
 * @package App\Containers\Content\Actions
 */
class GetContentAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $content = Apiato::call('Content@FindContentByIdTask', [$transporter->content_id]);

        return $content;
    }
}
