<?php

namespace App\Containers\Content\Actions;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\ExtractAddOnArrayTask;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class ExtractDataAndAskToCreateArticleSubAction extends SubAction {

    /**
     * @var CreateArticleSubAction
     */
    private $createArticleSubAction;

    /**
     * @var ExtractAddOnArrayTask
     */
    private $extractAddOnArrayTask;

    /**
     * ExtractDataAndAskToCreateArticleSubAction constructor.
     *
     * @param CreateArticleSubAction $createArticleSubAction
     * @param ExtractAddOnArrayTask  $extractAddOnArrayTask
     */
    public function __construct(CreateArticleSubAction $createArticleSubAction,
                                ExtractAddOnArrayTask $extractAddOnArrayTask) {
        $this->createArticleSubAction = $createArticleSubAction;
        $this->extractAddOnArrayTask = $extractAddOnArrayTask;
    }

    /**
     * @param DataTransporter $transporter
     * @param Content         $content
     *
     * @return Article
     */
    public function run(DataTransporter $transporter, Content $content): Article {
        $data = $this->extractAddOnArrayTask->run($transporter, 'article');

        $article = $this->createArticleSubAction->run($data, $content->id);

        return $article;
    }
}
