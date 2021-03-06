<?php

namespace App\Containers\Subject\Actions;

use App\Containers\Subject\Tasks\CreateSubjectTask;
use App\Containers\Tag\Models\Tag;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class CreateArticleSubAction
 *
 * @package App\Containers\Article\Actions
 */
class CreateSubjectSubAction extends SubAction
{
    /**
     * @var CreateSubjectTask $createSubjectTask
     */
    protected $createSubjectTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param CreateSubjectTask $createSubjectTask
     */
    public function __construct(CreateSubjectTask $createSubjectTask)
    {
        $this->createSubjectTask = $createSubjectTask;
    }

    /**
     * @param array $data
     *
     * @param int   $content_id
     *
     * @return Tag
     */
    public function run(array $data, int $content_id): Tag
    {
        $subjectData = [
            'subject' => $data['subject'],
        ];
        $subject = $this->createSubjectTask->run($content_id, $subjectData);

        return $subject;
    }
}