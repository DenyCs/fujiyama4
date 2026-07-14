<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'slug', 'order'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
