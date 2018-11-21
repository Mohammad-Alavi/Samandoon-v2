<?php

namespace App\Containers\Content\Actions;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Data\Transporters\CreateArticleTransporter;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Carbon\Exceptions\InvalidDateException;
use DB;
use Throwable;

class CreateContentAction extends Action
{
    private $createContentTask;
    private $createArticleSbAction;

    public function __construct(CreateContentTask $createContentTask, CreateArticleSubAction $createArticleSubAction)
    {
        $this->createContentTask = $createContentTask;
        $this->createArticleSbAction = $createArticleSubAction;
    }

    public function run(DataTransporter $transporter)
    {
        $data = $transporter->sanitizeInput([
            'article.title',
            'article.text',
        ]);

        DB::beginTransaction();
        try {
            // Create Content
            /** @var Content $content */
            $content = $this->createContent();
            // Create Article
            /** @var Article $article */
            $article = $this->createArticle($content->id, $data);
        } catch (Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        DB::commit();

        return $content;
    }

    /**
     * @param array $data
     * @return Content|mixed
     */
    private function createContent(array $data = [])
    {
        $content = $this->createContentTask->run($data);
        /** @var Content $content */
        return $content;
    }

    private function createArticle($content_id, array $data)
    {
        // Throw if data to create article are invalid
        throw_if(!isset($data['article']['title']) && !isset($data['article']['text']), InvalidDateException::class, 'Data to create Article are invalid');

        // Add Content id to array
        $dataWithContentId = [
            'title' => $data['article']['title'],
            'text' => $data['article']['text'],
            'content_id' => $content_id,
        ];
        // Pass the transporter to create new article linked to this newly created content
        $article = $this->createArticleSbAction->run(new CreateArticleTransporter($dataWithContentId));
        return $article;
    }
}
