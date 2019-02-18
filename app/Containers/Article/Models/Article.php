<?php

namespace App\Containers\Article\Models;

use App\Containers\Content\Models\Content;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class Article
 *
 * @package App\Containers\Article\Models
 */
class Article extends Model
{
    use SoftDeletes;
    use Searchable;

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'text' => $this->text,
        ];

        // Customize array...

        return $array;
    }

    /**
     * @var array
     */
    protected $fillable = [
        'text',
        'content_id',
    ];

    /**
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $casts = [

    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'articles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
