<?php

namespace Modules\Reservation\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Reservation extends Model
{
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'status', 'reservation_date', 'guest_count'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Order\Models\Order::class);
    }
}
