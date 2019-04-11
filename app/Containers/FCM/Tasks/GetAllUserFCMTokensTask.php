<?php

namespace App\Containers\FCM\Tasks;

use App\Containers\FCM\Data\Repositories\FCMTokenRepository;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllUserFCMTokensTask extends Task
{

    protected $repository;

    public function __construct(FCMTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($user_id)
    {
        $this->repository->pushCriteria(new ThisUserCriteria($user_id));
        return $this->repository->pluck('android_fcm_token')->toArray();
    }
}
