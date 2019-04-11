<?php

namespace App\Containers\Content\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisFCMTokensCriteria extends Criteria
{
    private $tokens;

    /**
     * ThisUserCriteria constructor.
     *
     * @param array $tokens
     */
    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereIn('android_fcm_token', '=', $this->tokens)->orWhereIn('apns_id', '=', $this->tokens);
    }
}
