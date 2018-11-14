<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Containers\Article\Models\Article;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class UpdateArticleTask
 * @package App\Containers\Article\Tasks
 */
class UpdateArticleTask extends Task
{

    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Article
     */
    public function run(int $id, array $data) : Article
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }
}
