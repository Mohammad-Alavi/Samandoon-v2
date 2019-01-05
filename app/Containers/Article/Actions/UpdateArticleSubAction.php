<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class UpdateArticleSubAction
 *
 * @package App\Containers\Article\Actions
 */
class UpdateArticleSubAction extends SubAction
{

    protected $updateArticleTask;

    /**
     * UpdateArticleSubAction constructor.
     *
     * @param UpdateArticleTask $updateArticleTask
     */
    public function __construct(UpdateArticleTask $updateArticleTask)
    {
        $this->updateArticleTask = $updateArticleTask;
    }

    /**
     * @param array $data
     *
     * @param       $id
     *
     * @return Article
     */
    public function run(array $data, $id): Article
    {

        $article = $this->updateArticleTask->run($id, $data);

        return $article;
    }
}
