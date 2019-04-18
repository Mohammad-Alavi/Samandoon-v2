<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Notifications\RepostNotification;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\FCM\Notifications\FCMChannel;
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

        // send repost notification to the reposted user if this post is a repost
        if ($this->content->repost != null) {
            /** @var Content $referenced_content */
            $referenced_content = Apiato::call('Content@FindContentByIdTask', [$this->content->repost->referenced_content_id]);
            /** @var User $targetUser */
            $targetUser = $referenced_content->user;
            // only send notification if someone beside the owner reposted the resource
            if ($this->authenticatedUser->id != $targetUser->id) {
                // send/save notification to database and send to FCM
                $targetUser->notifyNow(new RepostNotification($this->content->user, $referenced_content), [FCMChannel::class, 'database']);
            }
        };
        return $this->content;
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
}
