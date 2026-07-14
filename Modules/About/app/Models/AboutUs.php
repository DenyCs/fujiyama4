<?php

namespace Modules\About\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AboutUs extends Model
{
    use LogsActivity;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'subtitle',
        'story',
        'primary_photo_id',
        'secondary_photo_id',
    ];

    /**
     * Primary photo for the About Us section.
     */
    public function primaryPhoto()
    {
        return $this->belongsTo(AboutGallery::class, 'primary_photo_id');
    }

    /**
     * Secondary (overlap) photo for the About Us section.
     */
    public function secondaryPhoto()
    {
        return $this->belongsTo(AboutGallery::class, 'secondary_photo_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'subtitle'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the singleton content record.
     * Automatically creates a default record if none exists yet,
     * so the admin and client views never break.
     */
    public static function getContent(): self
    {
        return self::firstOrCreate(
            [],
            [
                'title'    => 'Tentang Kami',
                'subtitle' => 'Filosofi di Balik Setiap Mangkuk',
                'story'    => null,
            ]
        );
    }
}