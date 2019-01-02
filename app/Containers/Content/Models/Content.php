<?php

namespace App\Containers\Content\Models;

use App\Containers\Article\Models\Article;
use App\Containers\ExternalLink\Models\ExternalLink;
use App\Containers\Link\Models\Link;
use App\Containers\Repost\Models\Repost;
use App\Ship\Parents\Models\Model;

class Content extends Model
{
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
    protected $resourceKey = 'contents';

    public function article()
    {
        return $this->hasOne(Article::class);
    }

    public function repost()
    {
        return $this->hasOne(Repost::class);
    }

    public function link()
    {
        return $this->hasOne(Link::class);
    }
}
