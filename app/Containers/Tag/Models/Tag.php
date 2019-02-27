<?php

namespace App\Containers\Tag\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use \Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $fillable = [

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
    protected $resourceKey = 'tags';
}