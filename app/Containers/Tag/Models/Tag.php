<?php

namespace App\Containers\Tag\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Laravel\Scout\Searchable;
use \Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    use HashIdTrait;
    use HasResourceKeyTrait;
    use Searchable;

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        // Customize array...

        return $array;
    }

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

    public static function findFromString(string $name, string $type = null, string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return static::query()
            ->where(\DB::raw( "json_extract(name, '$." . $locale . "')" ), '=', $name)
            ->where('type', $type)
            ->first();
    }
}