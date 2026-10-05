<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'vehicle_type', 'vehicle_plate', 'is_online', 'current_latitude', 'current_longitude'])]
class Driver extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
