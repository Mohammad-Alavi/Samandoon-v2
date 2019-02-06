<?php

namespace App\Containers\Comment\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Comment\UI\API\Requests\CreateCommentRequest;
use App\Containers\Comment\UI\API\Requests\DeleteCommentRequest;
use App\Containers\Comment\UI\API\Transformers\CommentTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Comment\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateCommentRequest $request
     *
     * @return array
     */
    public function createComment(CreateCommentRequest $request)
    {
        $comment = Apiato::call('Comment@CreateCommentAction', [new DataTransporter($request)]);
        return $this->transform($comment, CommentTransformer::class);
    }

    public function deleteComment(DeleteCommentRequest $request)
    {
        Apiato::call('Comment@DeleteCommentAction', [new DataTransporter($request)]);
        return $this->noContent();
    }
}
