<?php

namespace Modules\Reservation\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    const STATUSES = [
        'pending' => 'Pending',
        'confirmed' => 'Dikonfirmasi',
        'cancelled' => 'Dibatalkan',
    ];

    protected $fillable = [
        'name',
        'phone',
        'reservation_date',
        'reservation_time',
        'guest_count',
        'note',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'guest_count' => 'integer',
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Order\Models\Order::class);
    }
}
