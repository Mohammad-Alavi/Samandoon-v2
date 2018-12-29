<?php

namespace App\Containers\Content\Tasks;

use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Validator;

class ValidateAddOnDataTask extends Task
{
    public function run(array $data, string $addOnType)
    {
        switch ($addOnType) {
            case 'article':
                $validator = Validator::make($data, [
                    'title' => 'required',
                    'text' => 'required',
                ]);
                throw_if($validator->fails(), ValidationFailedException::class, $validator->errors());
                break;
        }
    }
}
