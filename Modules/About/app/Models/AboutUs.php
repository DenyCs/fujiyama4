<?php

namespace Modules\About\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'subtitle',
        'story',
    ];

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