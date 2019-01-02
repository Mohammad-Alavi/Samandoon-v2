<?php

namespace App\Containers\Content\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\UI\API\Requests\CreateContentRequest;
use App\Containers\Content\UI\API\Requests\GetContentRequest;
use App\Containers\Content\UI\API\Requests\UpdateContentRequest;
use App\Containers\Content\UI\API\Transformers\ContentTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    public function createContent(CreateContentRequest $request)
    {
        $content = Apiato::call('Content@CreateContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    public function updateContent(UpdateContentRequest $request)
    {
        $content = Apiato::call('Content@UpdateContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    public function getContent(GetContentRequest $request)
    {
        $content = Apiato::call('Content@GetContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }
}
