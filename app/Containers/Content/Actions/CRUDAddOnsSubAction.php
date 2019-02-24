<?php
declare(strict_types=1);

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class CRUDAddOnsSubAction
 *
 * @package App\Containers\Content\Actions
 */
class CRUDAddOnsSubAction extends SubAction
{
    /**
     * @param array   $addOnData
     * @param array   $addOnNames
     * @param Content $content
     * @param string  $actionType
     */
    public function run(array $addOnNames, Content $content, string $actionType, array $addOnData = [])
    {
        foreach ($addOnNames as $addOnName) {
            // generate action name
            $actionName = $this->PrepareSubActionName($addOnName, $actionType);
            // call the appropriate action
            switch ($actionType) {
                case config('samandoon.action_to_perform_on_addon.create'):
                    Apiato::call($actionName, [$addOnData[lcfirst($addOnName)], $content->id]);
                    break;
                case config('samandoon.action_to_perform_on_addon.update'):
                    Apiato::call($actionName, [$addOnData[lcfirst($addOnName)], $content]);
                    break;
                case config('samandoon.action_to_perform_on_addon.delete'):
                    $addon = $content->$addOnName;
                    if ($addon) {
                        Apiato::call($actionName, [$addon->id]);
                    }
                    break;
            }
        }
    }

    /**
     * @param string $addOnName
     * @param string $actionType
     *
     * @return string
     */
    private function PrepareSubActionName(string $addOnName, string $actionType)
    {
        $actionType = ucfirst($actionType);
        $addOnName = ucfirst($addOnName);
        $actionName = $addOnName . '@' . $actionType . $addOnName . 'SubAction';
        return $actionName;
    }
}
