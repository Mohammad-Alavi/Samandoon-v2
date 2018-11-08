<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Ship\Parents\Models\UserModel;

class User extends UserModel {

    use AuthorizationTrait;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'email',
        'phone',
        'password',
        'points',
        'device',
        'platform',
        'gender',
        'birth',
        'confirmed',
        'is_client',

        'password_updated_at',
        'expired_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_client' => 'boolean',
        'confirmed' => 'boolean',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'password_updated_at',
        'expired_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
