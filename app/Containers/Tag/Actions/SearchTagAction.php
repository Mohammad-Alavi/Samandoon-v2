<?php

namespace App\Containers\Tag\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class SearchTagAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $sanitizedData = $transporter->sanitizeInput([
            'q',
            'tag_type',
        ]);

        return Apiato::call('Tag@SearchTagTask', [$sanitizedData, $transporter->limit]);
    }
}
