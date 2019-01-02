<?php

namespace App\Containers\Repost\Actions;

use App\Containers\Repost\Models\Repost;
use App\Containers\Repost\Tasks\CreateRepostTask;
use App\Ship\Parents\Actions\SubAction;

class CreateRepostSubAction extends SubAction
{
    /**
     * @var CreateRepostTask $createRepostTask
     */
    protected $createRepostTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param CreateRepostTask $createRepostTask
     */
    public function __construct(CreateRepostTask $createRepostTask)
    {
        $this->createRepostTask = $createRepostTask;
    }

    /**
     * @param array $data
     *
     * @param string $content_id
     *
     * @return Repost
     */
    public function run(array $data, string $content_id): Repost
    {
        $repostData = [
            'content_id' => $content_id,
            'referenced_content_id' => $data['referenced_content_id'],
        ];
        $repost = $this->createRepostTask->run($repostData);

        return $repost;
    }
}
