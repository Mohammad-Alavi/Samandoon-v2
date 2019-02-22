<?php

namespace App\Containers\Content\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class SearchContentAction extends Action
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
        ]);

        return Apiato::call('Content@SearchContentTask', [$sanitizedData, $transporter->limit]);

    }
}
