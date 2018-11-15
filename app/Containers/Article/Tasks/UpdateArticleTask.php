<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Containers\Article\Models\Article;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateArticleTask extends Task {

    /**
     * @var ArticleRepository
     */
    protected $repository;

    /**
     * UpdateArticleTask constructor.
     *
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @return Article
     */
    public function run(int $id, array $data): Article {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }
}
