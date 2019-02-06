<?php

namespace App\Containers\Comment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class FindCommentByIdAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $comment = Apiato::call('Comment@FindCommentByIdTask', [$transporter->id]);
        return $comment;
    }
}
