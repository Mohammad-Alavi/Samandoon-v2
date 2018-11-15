<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindArticleByIdTask extends Task {

    /**
     * @var ArticleRepository
     */
    protected $repository;

    /**
     * FindArticleByIdTask constructor.
     *
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function run(int $id) {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
