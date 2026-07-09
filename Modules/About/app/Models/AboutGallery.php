<?php

namespace Modules\About\Models;

use Illuminate\Database\Eloquent\Model;

class AboutGallery extends Model
{
    protected $table = 'about_gallery';

    protected $fillable = [
        'image',
        'category',
        'caption',
        'order',
    ];

    /**
     * Scope: filter gallery by category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
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