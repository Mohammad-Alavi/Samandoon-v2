<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Actions\UpdateArticleSubAction;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\UpdateContentTask;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Throwable;

class UpdateContentAction extends Action
{
    private $updateContentTask;
    private $updateArticleSubAction;

    public function __construct(UpdateContentTask $updateContentTask, UpdateArticleSubAction $updateArticleSubAction)
    {
        $this->updateContentTask = $updateContentTask;
        $this->updateArticleSubAction = $updateArticleSubAction;
    }

    public function run(DataTransporter $transporter)
    {
        $data = $transporter->sanitizeInput([
//        'have_someaddon',
            'article.title',
            'article.text',
            'content_id'
        ]);

        DB::beginTransaction();
        try {
            $content = $this->contentUpdater($data);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException($exception->getMessage());
        }
        DB::commit();

        return $content;
    }

    private function contentUpdater($data)
    {
        // Update Content
        /** @var Content $content */
        $content = $this->updateContent($data);

        // Update Article
        $this->updateArticle($data, $content);

        return $content;
    }

    /**
     * @param array $data
     * @return Content|mixed
     */
    private function updateContent(array $data = [])
    {
        // TODO change this if you want to update Content model itself
        // for now return content
        // because we don't have any data for content to update it
        /** @var Collection $content */
        $content = Apiato::call('Content@FindContentByIdTask', [$data['content_id']]);
        return $content;

//        $data = array_except($data, ['content_id']);
//        $content = $this->updateContentTask->run($data['content_id'], $data);
        /** @var Content $content */
//        return $content;
    }

    private function updateArticle(array $data, Content $content)
    {
        // Pass the array to update a new article linked to this newly created content
        $article = $this->updateArticleSubAction->run($data, $content);
        return $article;
    }
}