<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class UpdateContentAction
 *
 * @package App\Containers\Content\Actions
 */
class UpdateContentAction extends Action
{
    /** @var Content $content */
    private $content;
    /** @var CRUDAddOnsSubAction $CRUDAddOnsSubAction */
    private $CRUDAddOnsSubAction;
    private $extractAndValidateAddOnSubAction;

    /**
     * UpdateContentAction constructor.
     *
     * @param ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction
     * @param CRUDAddOnsSubAction              $CRUDAddOnsSubAction
     */
    public function __construct(ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction,
                                CRUDAddOnsSubAction $CRUDAddOnsSubAction)
    {
        $this->CRUDAddOnsSubAction = $CRUDAddOnsSubAction;
        $this->extractAndValidateAddOnSubAction = $extractAndValidateAddOnSubAction;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Content|mixed
     * @throws \Exception
     */
    public function run(DataTransporter $transporter)
    {
        DB::beginTransaction();
        try {
            $this->content = $this->updateContentAndItsAddOns($transporter);
            $this->content->updated_at = $this->updateUpdatedAtColumnOfContent($this->content);
            $this->content->saveOrFail();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException($exception->getMessage(), null, null, $exception->getCode());
        }
        DB::commit();

        return $this->content;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Content|mixed
     * @throws Throwable
     */
    private function updateContentAndItsAddOns(DataTransporter $transporter): Content
    {
        // TODO change this if you want to update Content model itself
        // for now return content
        // because we don't have any data for content to update it
        /** @var Content $content */
        $content = Apiato::call('Content@FindContentByIdTask', [$transporter['content_id']]);

        $addOnNameListForDeletion = [];
        $addOnNameListForUpdateOrCreation = [];
        $addOnNameListForCreation = [];
        $addOnNameListForUpdate = [];

        if ($transporter->exists('addon')) {
            foreach ($transporter->addon as $key => $value) {
                if ($value == 'false') {
                    array_push($addOnNameListForDeletion, $key);
                }
                elseif ($value == 'true') {
                    array_push($addOnNameListForUpdateOrCreation, $key);
                }
            }
        }

        // Create add on if content doesn't have it or Update it if Content have it
        foreach ($addOnNameListForUpdateOrCreation as $addOnName) {
            // Create AddOn list for creation
            if (!$content->$addOnName()->first()) {
                array_push($addOnNameListForCreation, $addOnName);
            } // Create AddOn list for update
            else {
                array_push($addOnNameListForUpdate, $addOnName);
            }
        }

        // CREATE ADD-ONS
        if (!empty($addOnNameListForCreation)) {
            // EXTRACT and VALIDATE Data for CREATION
            $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addOnNameListForCreation, config('samandoon.action_to_perform_on_addon.create'));
            $this->CRUDAddOnsSubAction->run($addOnNameListForCreation, $content, config('samandoon.action_to_perform_on_addon.create'), $addonDataArray);
        }

        // UPDATE ADD-ONS
        if (!empty($addOnNameListForUpdate)) {
            // EXTRACT and VALIDATE Data for UPDATE
            $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addOnNameListForUpdate, config('samandoon.action_to_perform_on_addon.update'));
            $this->CRUDAddOnsSubAction->run($addOnNameListForUpdate, $content, config('samandoon.action_to_perform_on_addon.update'), $addonDataArray);
        }

        // DELETE ADD-ONS
        if (!empty($addOnNameListForDeletion)) {
            // throw exception if user tries to delete article addon
            throw_if(in_array(config('samandoon.available_add_ons.article'), $addOnNameListForDeletion), UpdateResourceFailedException::class, 'You cannot delete the Article AddOn');
            $this->CRUDAddOnsSubAction->run($addOnNameListForDeletion, $content, config('samandoon.action_to_perform_on_addon.delete'));
        }

        return $content;
    }

    /**
     * @param Content $content
     */
    private function updateUpdatedAtColumnOfContent(Content $content): Carbon
    {
        /** @var Carbon $contentUpdatedAt */
        $contentUpdatedAt = $content->updated_at;

        foreach (config('samandoon.available_add_ons') as $addOnName) {
            // skip 'subject' addon because subject addon doesn't work like all other addons
            if ($addOnName == 'subject') continue;

            $addOn = $content->$addOnName()->withTrashed()->orderBy('updated_at', 'desc')->first();
            if ($addOn) {
                $contentUpdatedAt = $contentUpdatedAt->lt($addOn->created_at) ? $addOn->created_at : $contentUpdatedAt;
                $contentUpdatedAt = $contentUpdatedAt->lt($addOn->updated_at) ? $addOn->updated_at : $contentUpdatedAt;
                $contentUpdatedAt = $contentUpdatedAt->lt($addOn->deleted_at) ? $addOn->deleted_at : $contentUpdatedAt;
            }
        }
        return $contentUpdatedAt;
    }
}