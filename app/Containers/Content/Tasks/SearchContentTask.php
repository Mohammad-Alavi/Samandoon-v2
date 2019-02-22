<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Article\Models\Article;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

class SearchContentTask extends Task
{
    /**
     * @param     $data
     * @param int $limit
     *
     * @return Collection
     */
    public function run($data, $limit = 10)
    {
        /** @var Collection $result */
        $result = Article::Search(ArabicToPersianStringConverter::Convert($data['q']))->paginate($limit)->load('content');
        return $result;
    }
}
