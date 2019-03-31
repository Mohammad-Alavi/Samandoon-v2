<?php

namespace App\Containers\Content\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetAllContentsAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $sanitizedData = $transporter->sanitizeInput([
                'tag',
                'tag_type',
                'user_id',
            ]
        );
        $contents = Apiato::call('Content@GetAllContentsTask', [$sanitizedData]);

        return $contents;
    }
}
