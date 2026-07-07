<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Cart\Models\CartItem;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAttribute(): float
    {
        return $this->items->sum(function ($item) {
            return ($item->menu->price ?? 0) * $item->qty;
        });
    }

    /**
     * Get or create a cart for the current session/user
     */
    public static function getCurrent(): self
    {
        if (auth()->check()) {
            $cart = self::firstOrCreate(['user_id' => auth()->id()]);
        } else {
            $sessionId = session()->getId();
            $cart = self::firstOrCreate(['session_id' => $sessionId]);
        }

        return $cart;
    }
}