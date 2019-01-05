<?php

namespace App\Containers\Link\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Link
 *
 * @package App\Containers\Link\Models
 */
class Link extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'link_url',
        'content_id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
