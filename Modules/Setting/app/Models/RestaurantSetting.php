<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RestaurantSetting extends Model
{
    use LogsActivity;

    protected $table = 'restaurant_settings';

    protected $fillable = [
        'address',
        'latitude',
        'longitude',
        'phone',
        'google_maps_embed_url',
        'opening_hours',
        'footer_description',
        'copyright_text',
        'logo_dark',
        'logo_light',
        'favicon_image',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'latitude'      => 'decimal:7',
        'longitude'     => 'decimal:7',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['address', 'phone', 'opening_hours', 'footer_description', 'copyright_text', 'logo_dark', 'logo_light', 'favicon_image'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get or create the singleton restaurant settings record.
     */
    public static function getContent(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'address'               => 'Jl. Fujiyama No. 123, Kawasan Kuliner, Jakarta Selatan, DKI Jakarta 12980',
                'phone'                 => '+622112345678',
                'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1234567890!2d106.7890123!3d-6.2291234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnNDQuOCJTIDEwNsKwNDcnMjAuNCJF!5e0!3m2!1sid!2sid!4v1234567890123',
                'opening_hours'         => json_encode([
                    'senin'  => '11:00 - 22:00',
                    'selasa' => '11:00 - 22:00',
                    'rabu'   => '11:00 - 22:00',
                    'kamis'  => '11:00 - 22:00',
                    'jumat'  => '11:00 - 23:00',
                    'sabtu'  => '10:00 - 23:00',
                    'minggu' => '10:00 - 22:00',
                ]),
            ]
        );
    }

    /**
     * Check if the restaurant is currently open.
     */
    public function isOpen(): bool
    {
        $hours   = $this->opening_hours;
        $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $today   = $dayKeys[(int) now()->dayOfWeek]; // Carbon: 0=Sunday
        $timeNow = now()->format('H:i');

        if (! isset($hours[$today])) {
            return false;
        }

        $slot = trim($hours[$today]);
        if (mb_strtolower($slot) === 'tutup') {
            return false;
        }

        // Parse "HH:MM - HH:MM" format
        $parts = preg_split('/\s*-\s*/', $slot);
        if (count($parts) !== 2) {
            return false;
        }

        return $timeNow >= $parts[0] && $timeNow <= $parts[1];
    }

    /**
     * Get today's schedule string.
     */
    public function todaySchedule(): ?string
    {
        $hours   = $this->opening_hours;
        $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $today   = $dayKeys[(int) now()->dayOfWeek];

        return $hours[$today] ?? null;
    }

    /**
     * Get a compact opening hours summary for footer display.
     * Example: "Senin—Minggu: 11:00—22:00"
     */
    public function getOpeningHoursSummary(): string
    {
        $hours = $this->opening_hours;

        if (empty($hours) || !is_array($hours)) {
            return 'Jam operasional belum diatur';
        }

        // Try to find a common pattern
        $unique = array_unique(array_values($hours));

        if (count($unique) === 1) {
            return 'Setiap Hari: ' . reset($unique);
        }

        // Show today's schedule
        return $this->todaySchedule() ?? 'Jam operasional belum diatur';
    }
}
