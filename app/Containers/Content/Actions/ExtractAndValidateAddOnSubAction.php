<?php

namespace App\Containers\Content\Actions;

use App\Containers\Content\Tasks\ExtractAddOnDataTask;
use App\Containers\Content\Tasks\ValidateAddOnDataTask;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class ExtractAndValidateAddOnSubAction extends SubAction
{
    /** @var ExtractAddOnDataTask $createAddOnsSubAction */
    private $extractAddOnDataTask;
    /** @var ValidateAddOnDataTask $validateAddOnDataTask */
    private $validateAddOnDataTask;

    /**
     * CreateContentAction constructor.
     *
     * @param ExtractAddOnDataTask $extractAddOnDataTask
     * @param ValidateAddOnDataTask $validateAddOnDataTask
     */
    public function __construct(ExtractAddOnDataTask $extractAddOnDataTask,
                                ValidateAddOnDataTask $validateAddOnDataTask)
    {
        $this->extractAddOnDataTask = $extractAddOnDataTask;
        $this->validateAddOnDataTask = $validateAddOnDataTask;
    }

    /**
     * @param DataTransporter $transporter
     * @param array $addonType
     * @return array
     */
    public function run(DataTransporter $transporter, array $addonType)
    {
        foreach ($addonType as $addonName) {
            // Extract add-on data
            $data = $this->extractAddOnDataTask->run($transporter, $addonName);
            // Validate add-on data
            $this->validateAddOnDataTask->run($data, $addonName);
            // store validated data
            $validatedData = [
                $addonName => $data
            ];
            // return validated data
            return $validatedData;
        }
    }
}
