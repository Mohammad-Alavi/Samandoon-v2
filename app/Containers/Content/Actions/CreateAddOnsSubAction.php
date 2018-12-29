<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Ship\Parents\Actions\SubAction;

class CreateAddOnsSubAction extends SubAction
{
    // JUST INJECT SPECIFIC ADDON CLASS and it works without u want to do anything else

    /** @var CreateArticleSubAction $createArticleSubAction */
    private $createArticleSubAction;

    /**
     * CreateContentAction constructor.
     *
     * @param CreateArticleSubAction $createArticleSubAction
     */
    public function __construct(CreateArticleSubAction $createArticleSubAction)
    {
        $this->createArticleSubAction = $createArticleSubAction;
    }

    /**
     * @param array $addOnData
     * @param array $addOnList
     * @param string $content_id
     */
    public function run(array $addOnData, array $addOnList, string $content_id)
    {
        foreach ($addOnList as $addOn) {
            // generate action name
            $actionName = ucfirst($addOn) . '@Create' . ucfirst($addOn) . 'SubAction';
            // call the appropriate action
            Apiato::call($actionName, [$addOnData[lcfirst($addOn)], $content_id]);
        }
    }
}
