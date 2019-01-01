<?php

namespace App\Containers\Content\Models;

use App\Containers\Article\Models\Article;
use App\Containers\Repost\Models\Repost;
use App\Ship\Parents\Models\Model;
use Vinkla\Hashids\Facades\Hashids;

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

    public function Repost()
    {
        return $this->hasOne(Repost::class);
    }
}
