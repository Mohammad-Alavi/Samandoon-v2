<?php

namespace App\Containers\Content\Actions;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use DB;
use Throwable;

class CreateContentAction extends Action
{
    private $createContentTask;
    private $createArticleSubAction;

    public function __construct(CreateContentTask $createContentTask, CreateArticleSubAction $createArticleSubAction)
    {
        $this->createContentTask = $createContentTask;
        $this->createArticleSubAction = $createArticleSubAction;
    }

    public function run(DataTransporter $transporter)
    {
        $data = $transporter->sanitizeInput([
//            'have_someaddon',
            'article.title',
            'article.text',
        ]);

        DB::beginTransaction();
        try {
            $content = $this->contentBuilder($data);
        } catch (Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        DB::commit();

        return $content;
    }

    private function contentBuilder($data)
    {
        // Create Content
        /** @var Content $content */
        $content = $this->createContent();
        $data = array_add($data, 'content_id', $content->id);

        // Create Article
        $this->createArticle($data);

        ////
        // Create Addon -> If key exist and is true
        ////
//        if (array_key_exists('have_someaddon', $data) && $data['have_someaddon'] == true) {
            /** @var Article $article */
//            $some_addon = $this->sampleCreateAddonFunction($data);
//        }

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

    private function createArticle(array $data)
    {
        // Pass the array to create a new article linked to this newly created content
        $article = $this->createArticleSubAction->run($data);
        return $article;
    }

    private function sampleCreateAddonFunction(array $data)
    {
        $addon = true; // Call corresponding addon action and validate data there
        return $addon;
    }
}
