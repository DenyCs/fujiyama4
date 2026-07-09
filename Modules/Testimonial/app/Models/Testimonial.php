<?php

namespace Modules\Testimonial\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_photo',
        'rating',
        'review',
        'order_type',
        'status',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get the URL for customer photo, or null if not set.
     */
    public function getCustomerPhotoUrlAttribute(): ?string
    {
        if ($this->customer_photo) {
            return asset('storage/' . $this->customer_photo);
        }
        return null;
    }

    /**
     * Get initials from customer name (for avatar fallback).
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->customer_name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[count($words) - 1], 0, 1));
        }
        return strtoupper(substr($this->customer_name, 0, 2));
    }

    /**
     * Scope: only active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: ordered by 'order' field ascending.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}