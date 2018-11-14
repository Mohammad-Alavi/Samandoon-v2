<?php

namespace App\Containers\Article\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'text',
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
    protected $resourceKey = 'articles';

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
