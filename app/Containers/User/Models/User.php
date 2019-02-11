<?php

namespace App\Containers\User\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Content\Models\Content;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Models\UserModel;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends UserModel implements HasMedia {

    use AuthorizationTrait;
    use HasMediaTrait;
    use CanFollow, CanBeFollowed, CanLike;

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
        'is_client'               => 'boolean',
        'is_phone_confirmed'      => 'boolean',
        'is_email_confirmed'      => 'boolean',
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
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width((int)config('user-container.avatar.thumb.width'))
            ->height((int)'user-container.avatar.thumb.height')
            ->keepOriginalImageFormat()
            ->nonQueued()
            ->performOnCollections('avatar');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
        ->singleFile();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(content::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

}
