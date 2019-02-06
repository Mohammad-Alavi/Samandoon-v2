<?php

namespace App\Containers\Content\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Comment\Models\Comment;
use App\Containers\Link\Models\Link;
use App\Containers\Repost\Models\Repost;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Content
 *
 * @package App\Containers\Content\Models
 */
class Content extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id'
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

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'contents';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article()
    {
        return $this->hasOne(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function repost()
    {
        return $this->hasOne(Repost::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function link()
    {
        return $this->hasOne(Link::class);
    }

//    public function linkWithTrashed()
//    {
//        return $this->hasOne(Link::class);
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return bool|null|void
     * @throws \Throwable
     */
    public function delete()
    {
        DB::transaction(function () {
            foreach (config('samandoon.available_add_ons') as $addOnName) {
                $this->$addOnName()->delete();
//                $this->subjects()->detach();
            }

            // revoke user's permission to manage events and articles
//            $this->user->revokePermissionTo('manage-event');
//            $this->user->revokePermissionTo('manage-article');

            parent::delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
