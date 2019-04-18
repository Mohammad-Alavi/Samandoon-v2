<?php

namespace App\Containers\Link\Tasks;

use App\Ship\Parents\Tasks\Task;
use shweshi\OpenGraph\OpenGraph;

class GetLinkOGDataTask extends Task
{
    /**
     * @param string $url
     *
     * @param bool   $get_all_meta_data
     *
     * @return array
     */
    public function run(string $url, bool $get_all_meta_data)
    {
        return (new OpenGraph())->fetch($url, $get_all_meta_data);
    }
}
