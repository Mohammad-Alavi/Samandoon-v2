<?php

namespace App\Containers\Content\Actions;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use DB;
use Throwable;

class CreateContentAction extends Action
{
    /** @var CreateContentTask $createContentTask */
    private $createContentTask;
    /** @var CreateAddOnsSubAction $createAddOnsSubAction */
    private $createAddOnsSubAction;
    /** @var ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction */
    private $extractAndValidateAddOnSubAction;

    /**
     * @var Content
     */
    private $content;

    /**
     * CreateContentAction constructor.
     *
     * @param CreateContentTask $createContentTask
     * @param ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction
     * @param CreateAddOnsSubAction $createAddOnsSubAction
     */
    public function __construct(CreateContentTask $createContentTask,
                                ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction,
                                CreateAddOnsSubAction $createAddOnsSubAction)
    {
        $this->createContentTask = $createContentTask;
        $this->createAddOnsSubAction = $createAddOnsSubAction;
        $this->extractAndValidateAddOnSubAction = $extractAndValidateAddOnSubAction;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Content | string
     * @throws \Exception
     */
    public function run(DataTransporter $transporter)
    {
        DB::beginTransaction();
        try {
            $this->createContentAndItsAddOns($transporter);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new CreateResourceFailedException($exception->getMessage(), null,null,$exception->getCode());
        }
        DB::commit();

        return $this->content;
    }

    /**
     * @param DataTransporter $transporter
     */
    private function createContentAndItsAddOns(DataTransporter $transporter): void
    {
        // Create Content
        $this->content = $this->createContentTask->run();

        /// ADD ANY ADDON NAME YOU WANT TO BE CREATED WITH THE CONTENT
        ///  Create add-on if everything is OK ///
        $addOnNameList = $transporter->add_on_list;

        // Validate and return extracted and validated addon array
        $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addOnNameList);

        // create add-ons
        $this->createAddOnsSubAction->run($addonDataArray, $addOnNameList, $this->content->id);
    }
}
