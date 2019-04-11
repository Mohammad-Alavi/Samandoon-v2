<?php

namespace App\Containers\Content\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisContentCriteria extends Criteria
{

    /**
     * @var int
     */
    private $contentId;

    /**
     * ThisUserCriteria constructor.
     *
     * @param $userId
     */
    public function __construct($contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('content_id', '=', $this->contentId);
    }

}
