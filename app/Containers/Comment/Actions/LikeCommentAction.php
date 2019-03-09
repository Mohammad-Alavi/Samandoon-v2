<?php

namespace App\Containers\Comment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class LikeCommentAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     */
    public function run(DataTransporter $dataTransporter)
    {
        $authenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $comment = Apiato::call('Comment@FindCommentByIdTask', [$dataTransporter->comment_id]);

        return Apiato::call('Comment@LikeCommentTask', [$authenticatedUser, $comment]);
    }
}
