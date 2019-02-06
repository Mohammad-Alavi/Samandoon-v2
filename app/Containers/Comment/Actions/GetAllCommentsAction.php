<?php

namespace App\Containers\Comment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetAllCommentsAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $content = Apiato::call('Content@FindContentByIdTask', [$transporter->content_id]);
        $comments = Apiato::call('Comment@GetAllCommentsTask', [$content->id], ['OrderByCreationDateDescendingCriteria']);
        return $comments;
    }
}
