<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Banner extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'cta_text',
        'cta_link',
        'order',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Scope: hanya banner dengan status active.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Default order by "order" ascending.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Ambil URL gambar (storage).
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/banners/' . $this->image);
    }

    /**
     * Cek apakah banner sedang aktif.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}