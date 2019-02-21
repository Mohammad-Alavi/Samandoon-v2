<?php

namespace App\Containers\Content\Tasks;

use App\Ship\Parents\Tasks\Task;

class ExtractHashtagsFromStringTask extends Task
{
    public function run(string $data)
    {
        preg_match_all('/#([^\s]+)/', $data, $hashtags);

//        $hashtags = implode(',', $matches[1]);

        return $hashtags[1];
    }
}
