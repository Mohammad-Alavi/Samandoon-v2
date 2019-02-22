<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

class SearchUserTask extends Task
{
    public function run($data, $limit = 10)
    {
        /** @var Collection $result */
        $result = User::Search(ArabicToPersianStringConverter::Convert($data['q']))->paginate($limit);
        return $result;
    }
}
