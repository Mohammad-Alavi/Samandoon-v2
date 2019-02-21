<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\ExtractHashtagsFromStringTask;
use App\Containers\Content\Tasks\FindContentByIdTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class CreateArticleSubAction
 *
 * @package App\Containers\Article\Actions
 */
class CreateArticleSubAction extends SubAction
{

    /** @var CreateArticleTask $createArticleTask */
    protected $createArticleTask;
    /** @var ExtractHashtagsFromStringTask $extractHashtagsFromStringTask */
    protected $extractHashtagsFromStringTask;
    /** @var FindContentByIdTask $findContentByIdTask */
    protected $findContentByIdTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param CreateArticleTask $createArticleTask
     */
    public function __construct(CreateArticleTask $createArticleTask,
                                ExtractHashtagsFromStringTask $extractHashtagsFromStringTask,
                                FindContentByIdTask $findContentByIdTask)
    {
        $this->createArticleTask = $createArticleTask;
        $this->extractHashtagsFromStringTask = $extractHashtagsFromStringTask;
        $this->findContentByIdTask = $findContentByIdTask;
    }

    /**
     * @param array  $data
     *
     * @param string $content_id
     *
     * @return Article
     */
    public function run(array $data, string $content_id): Article
    {
        $articleData = [
            'text' => $data['text'],
            'content_id' => $content_id,
        ];

        /** @var Article $article */
        $article = $this->createArticleTask->run($articleData);

        /** @var array $articleTags */
        $articleTags = $this->extractHashtagsFromStringTask->run($articleData['text']);
        /** @var Content $content */
        $content = $this->findContentByIdTask->run($articleData['content_id']);

        //attach tags that are in article to content
        $content->attachTags($articleTags);

        return $article;
    }
}
