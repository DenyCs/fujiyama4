<?php

namespace Modules\About\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AboutGallery extends Model
{
    use LogsActivity;

    protected $table = 'about_gallery';

    protected $fillable = [
        'gallery_category_id',
        'image',
        'caption',
        'order',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['caption', 'gallery_category_id', 'order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relasi ke GalleryCategory.
     */
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    /**
     * Scope: filter gallery by category ID.
     */
    public function scopeCategory($query, $categoryId)
    {
        return $query->where('gallery_category_id', $categoryId);
    }

    /**
     * Accessor: image_url untuk tampilan client & admin.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/about/' . $this->image);
        }
        return asset('images/placeholder.jpg');
    }
}