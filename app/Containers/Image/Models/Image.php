<?php

namespace App\Containers\Image\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Image extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;

    protected $fillable = [
        'content_id'
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
        'media',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'images';

    public function registerMediaConversions(Media $media = null)
    {
//        $this->addMediaConversion('thumb')
//            ->width((int)config('user-container.avatar.thumb.width'))
//            ->height((int)'user-container.avatar.thumb.height')
//            ->keepOriginalImageFormat()
//            ->nonQueued()
//            ->performOnCollections('image');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
