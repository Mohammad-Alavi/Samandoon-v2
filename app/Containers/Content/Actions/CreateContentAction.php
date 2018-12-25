<?php

namespace App\Containers\Content\Actions;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use DB;
use Throwable;

class CreateContentAction extends Action {

    /**
     * @var CreateContentTask
     */
    private $createContentTask;

    /**
     * @var ExtractDataAndAskToCreateArticleSubAction
     */
    private $extractDataAndAskToCreateArticleSubAction;

    /**
     * @var Content
     */
    private $content;

    /**
     * CreateContentAction constructor.
     *
     * @param CreateContentTask                         $createContentTask
     * @param ExtractDataAndAskToCreateArticleSubAction $extractDataAndAskToCreateArticleSubAction
     */
    public function __construct(CreateContentTask $createContentTask,
                                ExtractDataAndAskToCreateArticleSubAction $extractDataAndAskToCreateArticleSubAction) {
        $this->createContentTask = $createContentTask;
        $this->extractDataAndAskToCreateArticleSubAction = $extractDataAndAskToCreateArticleSubAction;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Content | string
     */
    public function run(DataTransporter $transporter) {

        DB::beginTransaction();
        try {
            $this->createContentAndItsAddOns($transporter);
        } catch (Throwable $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
        DB::commit();

        return $this->content;
    }

    /**
     * @param DataTransporter $transporter
     */
    private function createContentAndItsAddOns(DataTransporter $transporter): void {
        $this->content = $this->createContentTask->run();

        //  Create Article (no need to check if 'hasArticle')
        $this->extractDataAndAskToCreateArticleSubAction->run($transporter, $this->content);

//        if ($transporter['hasPoll'])
//            $this->extractDataAndAskToCreatePollSubAction->run($transporter, $this->content);
    }

}
