<?php

namespace App\Containers\Repost\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Repost
 *
 * @package App\Containers\Repost\Models
 */
class Repost extends Model
{
    use SoftDeletes;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

//    public function  referencedContent()
//    {
//
//    }
}
