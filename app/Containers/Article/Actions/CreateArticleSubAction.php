<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\ExtractHashtagsFromStringTask;
use App\Containers\Content\Tasks\FindContentByIdTask;
use App\Containers\Tag\Models\Tag;
use App\Ship\Exceptions\CreateResourceFailedException;
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

    /**
     * CreateArticleSubAction constructor.
     *
     * @param CreateArticleTask             $createArticleTask
     * @param ExtractHashtagsFromStringTask $extractHashtagsFromStringTask
     * @param FindContentByIdTask           $findContentByIdTask
     */
    public function __construct(CreateArticleTask $createArticleTask,
                                ExtractHashtagsFromStringTask $extractHashtagsFromStringTask)
    {
        $this->createArticleTask = $createArticleTask;
        $this->extractHashtagsFromStringTask = $extractHashtagsFromStringTask;
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

        // throw an exception if the max number of tags reached
        $max_tag_number = config('samandoon.maximum_allowed_tag_number');
        throw_if(count($articleTags) > $max_tag_number, CreateResourceFailedException::class, 'maximum allowed number of tags in a content reached. ' . 'max tag number: ' . $max_tag_number);

        /** @var Tag $tagsWithTypeOfContent */
        $tagsWithTypeOfContent = Tag::findOrCreate($articleTags, config('samandoon.tag_type.content'));
        /** @var Content $content */
        $content = $article->content;

        //attach tags that are in article to content
        $content->attachTags($tagsWithTypeOfContent);

        return $article;
    }
}
