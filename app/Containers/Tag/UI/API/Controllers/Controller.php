<?php

namespace App\Containers\Tag\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Tag\UI\API\Requests\GetTrendingTagsRequest;
use App\Containers\Tag\UI\API\Transformers\TagTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    public function getTrendingTags(GetTrendingTagsRequest $request)
    {
        $content = Apiato::call('Tag@GetTrendingTagsAction', [new DataTransporter($request)]);
        return $this->transform($content, TagTransformer::class);
    }
}
