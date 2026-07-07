<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Menu\Models\Menu;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'menu_id', 'qty', 'note'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function getSubtotalAttribute(): float
    {
        return ($this->menu->price ?? 0) * $this->qty;
    }
}