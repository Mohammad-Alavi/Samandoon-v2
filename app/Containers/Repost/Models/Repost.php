<?php

namespace App\Containers\Repost\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;

class Repost extends Model
{
    protected $fillable = [
        'content_id',
        'referenced_content_id',
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
    protected $resourceKey = 'reposts';

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

//    public function  referencedContent()
//    {
//
//    }
}
