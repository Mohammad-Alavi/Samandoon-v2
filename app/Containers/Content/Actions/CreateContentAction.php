<?php

namespace App\Containers\Content\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use DB;
use Illuminate\Support\Facades\App;
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
    /** @var User $authenticatedUser */
    private $authenticatedUser;

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
            $this->authenticatedUser = $this->getAuthenticatedUser();
            $this->createContentAndItsAddOns($transporter, $this->authenticatedUser);
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
     * @param                 $authenticatedUser
     *
     * @throws Throwable
     */
    private function createContentAndItsAddOns(DataTransporter $transporter, $authenticatedUser)
    {
        //// Create Content
        $this->content = $this->createContentTask->run(['user_id' => $authenticatedUser->id]);

        $addonNames = [];
        foreach ($transporter->addon as $key => $value) {
            if ($value == 'true') {
                array_push($addonNames, $key);
            }
        }

        throw_if(!in_array('article', $addonNames) || !in_array('subject', $addonNames), CreateResourceFailedException::class, 'You must at least create the Article and Subject addon');

        // Validate and return extracted and validated addon array
        $addonDataArray = $this->extractAndValidateAddOnSubAction->run($transporter, $addonNames, config('samandoon.action_to_perform_on_addon.create'));
        // CREATE ADD-ONS
        $this->CRUDAddOnsSubAction->run($addonNames, $this->content, config('samandoon.action_to_perform_on_addon.create'), $addonDataArray);
    }

    private function getAuthenticatedUser()
    {
        /** @var GetAuthenticatedUserTask $getAuthenticatedUserTask */
        $getAuthenticatedUserTask = App::make(GetAuthenticatedUserTask::class);
        // Get the current user
        /** @var User $authenticatedUser */
        $authenticatedUser = $getAuthenticatedUserTask->run();

        return $authenticatedUser;
    }
}
