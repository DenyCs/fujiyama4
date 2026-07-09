<?php

namespace Modules\Faq\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
    ];

    /**
     * Scope: only active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Default order by "order" ascending.
     */
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('order', 'asc');
        });
    }

    /**
     * Local scope: ordered by 'order' field ascending.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}