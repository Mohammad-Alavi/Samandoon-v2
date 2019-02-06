<?php

namespace App\Containers\Comment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class DeleteCommentAction extends Action
{
    public function run(DataTransporter $request)
    {
        return Apiato::call('Comment@DeleteCommentTask', [$request->comment_id]);
    }
}
