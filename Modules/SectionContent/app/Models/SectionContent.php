<?php

namespace Modules\SectionContent\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SectionContent extends Model
{
    use LogsActivity;

    protected $fillable = [
        'section_key',
        'badge_text',
        'title',
        'subtitle',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['section_key', 'badge_text', 'title', 'subtitle'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get section content by key. If not found, create with defaults.
     *
     * @param string $key
     * @param array $defaults ['badge_text' => null, 'title' => '', 'subtitle' => null]
     * @return static
     */
    public static function get(string $key, array $defaults = []): static
    {
        return static::firstOrCreate(
            ['section_key' => $key],
            array_merge([
                'badge_text' => null,
                'title' => '',
                'subtitle' => null,
            ], $defaults)
        );
    }
}