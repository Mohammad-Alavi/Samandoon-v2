<?php

namespace App\Containers\Link\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;

class Link extends Model
{
    protected $fillable = [
        'link_url',
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

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'links';

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
