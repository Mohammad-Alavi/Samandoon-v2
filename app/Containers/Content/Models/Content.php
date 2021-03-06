<?php

namespace App\Containers\Content\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Comment\Models\Comment;
use App\Containers\Image\Models\Image;
use App\Containers\Link\Models\Link;
use App\Containers\Repost\Models\Repost;
use App\Containers\Tag\Models\Tag;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Spatie\Tags\HasTags;

/**
 * Class Content
 *
 * @package App\Containers\Content\Models
 */
class Content extends Model
{
    use SoftDeletes;
    use CanBeLiked;
    use HasTags;

    protected $fillable = [
        'user_id',
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
        'article',
        'repost',
        'link',
        'image',
        'subject',
        'user',
        'comments',
        'likers',
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

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    /**
     * @return MorphToMany
     */
    public function subject()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables')->where('type', config('samandoon.tag_type.subject'));
    }

    /**
     * @return bool|null|void
     * @throws \Throwable
     */
    public function delete()
    {
        DB::transaction(function () {
            foreach (config('samandoon.available_add_ons') as $addOnName) {
                if ($addOnName == 'subject') {
//                $this->subject()->detach();
                    continue;
                }
                $this->$addOnName()->delete();
            }

            // delete all comments of this content
            $this->comments()->delete();
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

    /**
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->withTimestamps()->orderBy('order_column');
    }

    /**
     * @return string
     */
    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * @param int $user_id
     *
     * @return bool
     */
    public function isCommentedBy(int $user_id): bool
    {
        return $this->comments->where('user_id', '=', $user_id)->count() > 0 ? true : false;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isRepostedBy(User $user): bool
    {
        $ref_content_id_of_reposts = [];
        $user->contents()->whereHas('repost')->each(function (Content $content) use (&$ref_content_id_of_reposts) {
            array_push($ref_content_id_of_reposts, $content->repost->referenced_content_id);
        });

        return in_array($this->id, $ref_content_id_of_reposts);
    }
}
