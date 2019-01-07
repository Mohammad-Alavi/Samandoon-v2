<?php

namespace App\Containers\User\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Comment\Models\Comment;
use App\Ship\Parents\Models\UserModel;

class User extends UserModel
{

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
        'one_time_password',
        'points',
        'gender',
        'birth',
        'is_client',
        'is_phone_confirmed',
        'is_email_confirmed',
        'is_subscription_expired',
        'password_updated_at',
        'one_time_password_updated_at',
        'subscription_expired_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_client' => 'boolean',
        'is_phone_confirmed' => 'boolean',
        'is_email_confirmed' => 'boolean',
        'is_subscription_expired' => 'boolean',
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
        'one_time_password_updated_at',
        'subscription_expired_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'one_time_password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
