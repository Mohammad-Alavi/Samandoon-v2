<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Actions\SubAction;

class CreateAddOnsSubAction extends SubAction
{
    /**
     * @param array $addOnData
     * @param array $addOnList
     * @param Content $content
     */
    public function run(array $addOnData, array $addOnList, Content $content)
    {
        foreach ($addOnList as $addOn) {
            // generate action name
            $actionName = ucfirst($addOn) . '@Create' . ucfirst($addOn) . 'SubAction';
            // call the appropriate action
            Apiato::call($actionName, [$addOnData[lcfirst($addOn)], $content->id]);
        }
    }
}
