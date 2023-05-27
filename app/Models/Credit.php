<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends Model
{
    protected $fillable = [
        'total',
        'months',
        'uuid',
    ];

    protected $table = 'credits';

    /**
     * @return BelongsTo
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}