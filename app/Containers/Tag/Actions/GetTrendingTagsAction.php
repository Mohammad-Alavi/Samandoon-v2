<?php

namespace App\Containers\Tag\Actions;

use App\Containers\Tag\Tasks\GetTrendingTagsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetTrendingTagsAction extends Action
{
    /** @var GetTrendingTagsTask $getTrendingTagsTask */
    protected $getTrendingTagsTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param GetTrendingTagsTask             $getTrendingTagsTask
     */
    public function __construct(GetTrendingTagsTask $getTrendingTagsTask)
    {
        $this->getTrendingTagsTask = $getTrendingTagsTask;
    }

    public function run(DataTransporter $transporter)
    {
        $data = $transporter->sanitizeInput([
            'period',
            'tag_type',
        ]);

        $tags = Apiato::call('Tag@GetTrendingTagsTask', [$data]);

        return $tags;
    }
}
