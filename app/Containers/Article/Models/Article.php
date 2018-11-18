<?php

namespace App\Containers\Article\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class Article extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
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
}
