<?php

namespace App\Containers\Tag\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Tag\UI\API\Requests\GetTrendingTagsRequest;
use App\Containers\Tag\UI\API\Requests\SearchTagRequest;
use App\Containers\Tag\UI\API\Transformers\TagTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    /**
     * @param GetTrendingTagsRequest $request
     *
     * @return array
     */
    public function getTrendingTags(GetTrendingTagsRequest $request)
    {
        $tag = Apiato::call('Tag@GetTrendingTagsAction', [new DataTransporter($request)]);
        return $this->transform($tag, TagTransformer::class);
    }

    /**
     * @param SearchTagRequest $request
     *
     * @return array
     */
    public function searchTag(SearchTagRequest $request)
    {
        $tag = Apiato::call('Tag@SearchTagAction', [new DataTransporter($request)]);
        return $this->transform($tag, TagTransformer::class);
    }
}
