<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdateUserAction extends Action
{

    /**
     * @param DataTransporter $data
     *
     * @return  User
     */
    public function run(DataTransporter $data): User
    {
        //  TODO: don't let user change its email or phone if any of them is confirmed
        //  TODO: OR
        //  TODO: make it not confirmed after gets edited

        $sanitizedData = $data->sanitizeInput([
            'first_name',
            'last_name',
            'nick_name',
            'email',
            'phone',
            'gender',
            'birth',
            'avatar',
        ]);

        if (array_key_exists('first_name', $sanitizedData)) {
            $sanitizedData['first_name'] = ArabicToPersianStringConverter::Convert($sanitizedData['first_name']);
        }

        if (array_key_exists('last_name', $sanitizedData)) {
            $sanitizedData['last_name'] = ArabicToPersianStringConverter::Convert($sanitizedData['last_name']);
        }

        if (array_key_exists('nick_name', $sanitizedData)) {
            $sanitizedData['nick_name'] = ArabicToPersianStringConverter::Convert($sanitizedData['nick_name']);
        }

        $user = Apiato::call('User@UpdateUserTask', [$sanitizedData, $data->id]);

        return $user;
    }
}
