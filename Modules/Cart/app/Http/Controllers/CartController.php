<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Models\Cart;
use Modules\Cart\Models\CartItem;
use Modules\Menu\Models\Menu;

class CartController extends Controller
{
    /**
     * Show the cart page.
     */
    public function index()
    {
        $cart = Cart::getCurrent()->load('items.menu.category');
        $cartItems = $cart->items->map(function ($item) {
            return [
                'id' => $item->id,
                'menu_id' => $item->menu_id,
                'name' => $item->menu->name,
                'category' => $item->menu->category->name ?? '',
                'price' => $item->menu->price,
                'image' => $item->menu->image,
                'qty' => $item->qty,
                'subtotal' => $item->subtotal,
                'note' => $item->note,
            ];
        })->values()->toArray();
        return view('cart::index', compact('cart', 'cartItems'));
    }

    /**
     * Add an item to the cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'qty' => 'integer|min:1',
            'note' => 'nullable|string|max:500',
        ]);

        $cart = Cart::getCurrent();
        $existing = $cart->items()->where('menu_id', $request->menu_id)->first();

        if ($existing) {
            $existing->update(['qty' => $existing->qty + ($request->qty ?? 1)]);
            if ($request->note) {
                $existing->update(['note' => $request->note]);
            }
        } else {
            $cart->items()->create([
                'menu_id' => $request->menu_id,
                'qty' => $request->qty ?? 1,
                'note' => $request->note,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Menu berhasil ditambahkan ke keranjang.',
                'count' => $cart->items()->sum('qty'),
            ]);
        }

        return back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update qty of a cart item (AJAX).
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update(['qty' => $request->qty]);

        if ($request->expectsJson()) {
            $cart = Cart::getCurrent()->load('items.menu');
            return response()->json([
                'success' => true,
                'subtotal' => number_format($cartItem->subtotal, 0, ',', '.'),
                'total' => number_format($cart->total, 0, ',', '.'),
                'count' => $cart->items()->sum('qty'),
            ]);
        }

        return back()->with('success', 'Jumlah menu diperbarui.');
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        if (request()->expectsJson()) {
            $cart = Cart::getCurrent()->load('items.menu');
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang.',
                'total' => number_format($cart->total, 0, ',', '.'),
                'count' => $cart->items()->sum('qty'),
            ]);
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}