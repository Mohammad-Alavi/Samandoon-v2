<?php

namespace App\Containers\Content\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\UI\API\Requests\CreateContentRequest;
use App\Containers\Content\UI\API\Requests\DeleteContentRequest;
use App\Containers\Content\UI\API\Requests\GetAllContentsRequest;
use App\Containers\Content\UI\API\Requests\GetContentRequest;
use App\Containers\Content\UI\API\Requests\SearchContentRequest;
use App\Containers\Content\UI\API\Requests\UpdateContentRequest;
use App\Containers\Content\UI\API\Transformers\ContentTransformer;
use App\Containers\Content\UI\API\Transformers\SearchContentTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Request;

/**
 * Class Controller
 *
 * @package App\Containers\Content\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateContentRequest $request
     *
     * @return array
     */
    public function createContent(CreateContentRequest $request)
    {
        $content = Apiato::call('Content@CreateContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    /**
     * @param UpdateContentRequest $request
     *
     * @return array
     */
    public function updateContent(UpdateContentRequest $request)
    {
        $content = Apiato::call('Content@UpdateContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    /**
     * @param GetContentRequest $request
     *
     * @return array
     */
    public function getContent(GetContentRequest $request)
    {
        $content = Apiato::call('Content@GetContentAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    /**
     * @param GetContentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteContent(DeleteContentRequest $request)
    {
        Apiato::call('Content@DeleteContentAction', [new DataTransporter($request)]);
        return $this->noContent();
    }

    /**
     * @param GetAllContentsRequest $request
     *
     * @return array
     */
    public function getAllContents(GetAllContentsRequest $request)
    {
        $content = Apiato::call('Content@GetAllContentsAction', [new DataTransporter($request)]);
        return $this->transform($content, ContentTransformer::class);
    }

    /**
     * @param SearchContentRequest $request
     *
     * @return array
     */
    public function searchContent(SearchContentRequest $request)
    {
        Request::exists('q') && Request::input('q') != '' ?
            $content = $this->transform(Apiato::call('Content@SearchContentAction', [new DataTransporter($request)]), SearchContentTransformer::class) :
            $content = $this->transform(Apiato::call('Content@GetAllContentsAction', [new DataTransporter($request)]), ContentTransformer::class);

        return $content;
    }
}
