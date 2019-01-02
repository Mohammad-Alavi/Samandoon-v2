<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Actions\SubAction;

class CreateAddOnsSubAction extends SubAction
{
    /**
     * @param array $addOnData
     * @param array $addOnNames
     * @param Content $content
     */
    public function run(array $addOnData, array $addOnNames, Content $content)
    {
        foreach ($addOnNames as $addOnName) {
            // generate action name
            $actionName = ucfirst($addOnName) . '@Create' . ucfirst($addOnName) . 'SubAction';
            // call the appropriate action
            Apiato::call($actionName, [$addOnData[lcfirst($addOnName)], $content->id]);
        }
    }
}
