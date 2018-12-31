<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Content\Models\Content;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateContentAction extends Action
{
    private $content;
    private $updateAddOnsSubAction;
    private $extractAndValidateAddOnSubAction;
    private $deleteAddOnsSubAction;
    private $createAddOnsSubAction;

    public function __construct(ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction,
                                DeleteAddOnsSubAction $deleteAddOnsSubAction,
                                CreateAddOnsSubAction $createAddOnsSubAction,
                                UpdateAddOnsSubAction $updateAddOnsSubAction)
    {
        $this->updateAddOnsSubAction = $updateAddOnsSubAction;
        $this->deleteAddOnsSubAction = $deleteAddOnsSubAction;
        $this->extractAndValidateAddOnSubAction = $extractAndValidateAddOnSubAction;
        $this->createAddOnsSubAction = $createAddOnsSubAction;
    }

    public function run(DataTransporter $transporter)
    {
        DB::beginTransaction();
        try {
            $this->content = $this->updateContentAndItsAddOns($transporter);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException($exception->getMessage(), null, null, $exception->getCode());
        }
        DB::commit();

        return $this->content;
    }

    /**
     * @param DataTransporter $transporter
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
        foreach ($transporter->addon as $key => $value) {
            if ($value == 'false') {
                // throw exception if user tries to delete article addon
                throw_if($key == 'article', UpdateResourceFailedException::class, 'You cannot delete the Article AddOn');
                array_push($addOnNameListForDeletion, $key);
            } elseif ($value == 'true') {
                array_push($addOnNameListForUpdateOrCreation, $key);
            }
        }

        // Delete add-ons
        $this->deleteAddOnsSubAction->run($addOnNameListForDeletion, $content);

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

        if (!empty($addOnNameListForCreation)) {
            // Extract and Validate Data
            $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addOnNameListForCreation, config('samandoon.validation_type.create'));
            // create add-ons
            $this->createAddOnsSubAction->run($addonDataArray, $addOnNameListForCreation, $content);
        } elseif (!empty($addOnNameListForUpdate)) {
            // Extract and Validate Data
            $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addOnNameListForUpdate, config('samandoon.validation_type.update'));
            // Update Add-ons
            $this->updateAddOnsSubAction->run($addonDataArray, $addOnNameListForUpdate, $content);
        }

        return $content;
    }
}