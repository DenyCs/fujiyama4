<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SocialLink extends Model
{
    use LogsActivity;

    protected $fillable = [
        'platform',
        'url',
        'icon',
        'order',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['platform', 'url', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order');
    }

    /**
     * Map platform name to a friendly icon identifier.
     */
    public function getIconIdentifierAttribute(): string
    {
        if ($this->icon) {
            return $this->icon;
        }

        return match (mb_strtolower($this->platform)) {
            'instagram' => 'instagram',
            'facebook' => 'facebook',
            'tiktok' => 'tiktok',
            'whatsapp' => 'whatsapp',
            'youtube' => 'youtube',
            'twitter', 'twitter/x' => 'twitter',
            default => 'link',
        };
    }
}