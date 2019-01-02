<?php

namespace App\Containers\Content\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetContentAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $content = Apiato::call('Content@FindContentByIdTask', [$transporter->content_id]);

        return $content;
    }
}
