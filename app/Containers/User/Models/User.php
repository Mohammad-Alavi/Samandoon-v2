<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Content\Models\Content;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Models\UserModel;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends UserModel implements HasMedia
{

    use AuthorizationTrait;
    use HasMediaTrait;
    use CanFollow, CanBeFollowed, CanLike;
    use Searchable;

    public $asYouType = true;
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
        'description',
        'email',
        'username',
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
        'birth'
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
    protected $with = [
//        'followings',
//        'followers',
    ];

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'nick_name' => $this->nick_name,
            'username' => $this->username,
        ];

        // Customize array...

        return $array;
    }

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
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return array
     */
    public function subjectCategoryCount(): array
    {
        $subjectNameArray = [];
        $this->contents->each(function (Content $query) use (&$subjectNameArray) {
            // get the subject of the content
            $subject = $query->subject->first();
            array_push($subjectNameArray, $subject->name);
        });
        // count how many of each subject this array has
        // example: it has 4 علمی and 1 فرهنگی
        $result = array_count_values($subjectNameArray);
        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(content::class);
    }
}
