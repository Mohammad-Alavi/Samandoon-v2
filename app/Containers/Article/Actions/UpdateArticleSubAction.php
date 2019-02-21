<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\ExtractHashtagsFromStringTask;
use App\Containers\Content\Tasks\FindContentByIdTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class UpdateArticleSubAction
 *
 * @package App\Containers\Article\Actions
 */
class UpdateArticleSubAction extends SubAction
{
    /** @var UpdateArticleTask $updateArticleTask */
    protected $updateArticleTask;
    /** @var ExtractHashtagsFromStringTask $extractHashtagsFromStringTask */
    protected $extractHashtagsFromStringTask;
    /** @var FindContentByIdTask $findContentByIdTask */
    protected $findContentByIdTask;
    /**
     * UpdateArticleSubAction constructor.
     *
     * @param UpdateArticleTask $updateArticleTask
     */
    public function __construct(UpdateArticleTask $updateArticleTask,
                                ExtractHashtagsFromStringTask $extractHashtagsFromStringTask,
                                FindContentByIdTask $findContentByIdTask)
    {
        $this->updateArticleTask = $updateArticleTask;
        $this->extractHashtagsFromStringTask = $extractHashtagsFromStringTask;
        $this->findContentByIdTask = $findContentByIdTask;
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

        /** @var array $articleTags */
        $articleTags = $this->extractHashtagsFromStringTask->run($data['text']);
        /** @var Content $content */
        $content = $this->findContentByIdTask->run($id);

        //attach tags that are in article to content
        $content->syncTags($articleTags);

        return $article;
    }
}
