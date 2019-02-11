<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UnlikeAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     */
    public function run(DataTransporter $dataTransporter)
    {
        $authenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $content = Apiato::call('Content@FindContentByIdTask', [$dataTransporter->content_id]);

        return Apiato::call('User@UnlikeTask', [$authenticatedUser, $content]);
    }
}
