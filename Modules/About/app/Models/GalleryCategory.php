<?php

namespace Modules\About\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GalleryCategory extends Model
{
    use LogsActivity;

    protected $table = 'gallery_categories';

    protected $fillable = [
        'name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function galleries()
    {
        return $this->hasMany(AboutGallery::class, 'gallery_category_id');
    }
}