<?php

namespace App\Containers\Subject\Actions;

use App\Containers\Subject\Tasks\UpdateSubjectTask;
use App\Containers\Tag\Models\Tag;
use App\Ship\Parents\Actions\SubAction;

class UpdateSubjectSubAction extends SubAction
{
    /**
     * @var UpdateSubjectTask $updateSubjectTask
     */
    protected $updateSubjectTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param UpdateSubjectTask $updateSubjectTask
     */
    public function __construct(UpdateSubjectTask $updateSubjectTask)
    {
        $this->updateSubjectTask = $updateSubjectTask;
    }

    /**
     * @param array $data
     *
     * @param int   $content_id
     *
     * @return Tag
     */
    public function run(array $data, $content): Tag
    {
        $subjectData = [
            'subject' => $data['subject'],
        ];
        $subject = $this->updateSubjectTask->run($content->id, $subjectData);

        return $subject;
    }
}
