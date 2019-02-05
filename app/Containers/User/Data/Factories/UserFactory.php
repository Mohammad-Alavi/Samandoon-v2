<?php

use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = Hash::make('testing-password'),
        'remember_token' => str_random(10),
        'is_client'      => false,
    ];
});

$factory->state(User::class, 'client', function (Faker\Generator $faker) {
    return [
        'is_client' => true,
    ];
});
