<?php

namespace App\Containers\Comment\Models;

use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

/**
 * Class Comment
 *
 * @package App\Containers\Comment\Models
 */
class Comment extends Model
{
    use SoftDeletes;
    use CanBeLiked;

    protected $fillable = [
        'body',
        'content_id',
        'user_id',
        'parent_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'user',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'comments';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
