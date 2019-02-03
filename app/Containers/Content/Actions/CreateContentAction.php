<?php

namespace App\Containers\Content\Actions;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use DB;
use Throwable;

/**
 * Class CreateContentAction
 *
 * @package App\Containers\Content\Actions
 */
class CreateContentAction extends Action
{
    /** @var CreateContentTask $createContentTask */
    private $createContentTask;
    /** @var CRUDAddOnsSubAction $CRUDAddOnsSubAction */
    private $CRUDAddOnsSubAction;
    /** @var ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction */
    private $extractAndValidateAddOnSubAction;

    /**
     * @var Content
     */
    private $content;

    /**
     * CreateContentAction constructor.
     *
     * @param CreateContentTask                $createContentTask
     * @param ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction
     * @param CRUDAddOnsSubAction              $CRUDAddOnsSubAction
     */
    public function __construct(CreateContentTask $createContentTask,
                                ExtractAndValidateAddOnSubAction $extractAndValidateAddOnSubAction,
                                CRUDAddOnsSubAction $CRUDAddOnsSubAction)
    {
        $this->createContentTask = $createContentTask;
        $this->CRUDAddOnsSubAction = $CRUDAddOnsSubAction;
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
            throw new CreateResourceFailedException($exception->getMessage(), null, null, $exception->getCode());
        }
        DB::commit();

        return $this->content;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @throws Throwable
     */
    private function createContentAndItsAddOns(DataTransporter $transporter): void
    {
        // Create Content
        $this->content = $this->createContentTask->run(['user_id' => $transporter->id]);

        $addonNames = [];
        foreach ($transporter->addon as $key => $value) {
            if ($value == 'true') {
                array_push($addonNames, $key);
            }
        }

        throw_if(!in_array('article', $addonNames), CreateResourceFailedException::class, 'You must at least create the Article addon');

        // Validate and return extracted and validated addon array
        $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addonNames, config('samandoon.action_to_perform_on_addon.create'));
        // CREATE ADD-ONS
        $this->CRUDAddOnsSubAction->run($addonNames, $this->content, config('samandoon.action_to_perform_on_addon.create'), $addonDataArray);
    }
}
