<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Actions\SubAction;

class DeleteAddOnsSubAction extends SubAction
{
    public function run(array $addOnList, Content $content)
    {
        foreach ($addOnList as $addOn) {
            // generate action name
            $actionName = ucfirst($addOn) . '@Delete' . ucfirst($addOn) . 'Task';
            // call the appropriate action
            $addOn = lcfirst($addOn);
            if ($content->$addOn()->first()) {
                Apiato::call($actionName, [$content->$addOn()->first()->id]);
            }
        }
    }
}
