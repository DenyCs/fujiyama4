<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
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