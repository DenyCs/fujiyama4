<?php

namespace Modules\Event\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static \Illuminate\Database\Eloquent\Builder active()
 */
class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image',
        'location',
        'discount_promo',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * Scope: hanya event aktif yang belum kadaluarsa.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now()->toDateString());
    }

    /**
     * Cek apakah event saat ini sedang aktif.
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date->gte(now()->startOfDay());
    }

    /**
     * Accessor: image_url untuk tampilan client.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/event-placeholder.jpg');
    }

    /**
     * Accessor: appends image_url ke array/JSON.
     */
    protected function getArrayableAppends(): array
    {
        return array_merge(parent::getArrayableAppends(), ['image_url']);
    }

    public function getImageUrlAttributeFromArray(): void
    {
        // prevent override — handled by accessor above
    }
}