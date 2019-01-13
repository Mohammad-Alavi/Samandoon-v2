<?php

namespace App\Containers\Transaction\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class Transaction extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'points',
        'gateway',
        'authority',
        'payment_url',
        'ref_id',
        'description',
        'paid_at',
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
        'paid_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'transactions';
}
