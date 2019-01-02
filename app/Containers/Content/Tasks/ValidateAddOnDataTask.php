<?php

namespace App\Containers\Content\Tasks;

use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Validator;

class ValidateAddOnDataTask extends Task
{
    public function run(array $data, string $addOnName, string $validationType)
    {
        switch ($validationType) {
            case config('samandoon.validation_type.create'):
                $this->validateDataForCreation($data, $addOnName);
                break;
            case config('samandoon.validation_type.update'):
                $this->validateDataForUpdate($data, $addOnName);
                break;
        }

    }

    private function validateDataForCreation(array $data, string $addOnName)
    {
        switch ($addOnName) {
            case 'article':
                $validator = Validator::make($data, [
                    'title' => 'required',
                    'text' => 'required',
                ]);
                throw_if($validator->fails(), ValidationFailedException::class, $validator->errors());
                break;
            case 'repost':
                $validator = Validator::make($data, [
                    'referenced_content_id' => 'required|exists:contents,id',
                ]);
                throw_if($validator->fails(), ValidationFailedException::class, $validator->errors());
                break;
        }
    }

    private function validateDataForUpdate(array $data, string $addOnName)
    {
        switch ($addOnName) {
            case 'article':
                $validator = Validator::make($data, [
//                    'title' => 'required',
//                    'text' => 'required',
                ]);
                throw_if($validator->fails(), ValidationFailedException::class, $validator->errors());
                break;
        }
    }
}
