<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Article\Models\Article;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchContentTask extends Task
{
    /**
     * @param     $data
     * @param int $limit
     *
     * @return LengthAwarePaginator
     */
    public function run($data, $limit = 10)
    {
        /** @var LengthAwarePaginator $result */
        $result = Article::search(ArabicToPersianStringConverter::Convert($data['q']))->paginate($limit);
        return $result;
    }
}
