<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Models\Cart;
use Modules\Order\Models\Order;

class OrderController extends Controller
{
    /**
     * Show checkout page with cart summary.
     */
    public function checkout()
    {
        $cart = Cart::getCurrent()->load('items.menu');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda masih kosong. Silakan tambahkan menu terlebih dahulu.');
        }

        return view('order::checkout', compact('cart'));
    }

    /**
     * Store the order from checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'string', 'max:20', 'regex:/^(08|\+62)[0-9]+$/'],
            'note' => 'nullable|string|max:1000',
        ]);

        $cart = Cart::getCurrent()->load('items.menu');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $totalPrice = 0;
        $orderItems = [];

        foreach ($cart->items as $item) {
            $subtotal = $item->menu->price * $item->qty;
            $totalPrice += $subtotal;

            $orderItems[] = [
                'menu_id' => $item->menu_id,
                'menu_name' => $item->menu->name,
                'price' => $item->menu->price,
                'qty' => $item->qty,
                'subtotal' => $subtotal,
            ];
        }

        $order = DB::transaction(function () use ($request, $cart, $totalPrice, $orderItems) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => Order::generateOrderCode(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'total_price' => $totalPrice,
                'payment_method' => 'whatsapp',
                'note' => $request->note,
            ]);

            $order->items()->createMany($orderItems);

            // Clear cart
            $cart->items()->delete();

            return $order;
        });

        // Generate WhatsApp message
        $whatsappNumber = config('services.whatsapp.number');
        $message = "*Fujiyama Ramen — Pesanan Baru*\n\n";
        $message .= "*Kode Pesanan:* {$order->order_code}\n";
        $message .= "*Nama:* {$order->customer_name}\n";
        $message .= "*No HP:* {$order->customer_phone}\n\n";
        $message .= "*Detail Pesanan:*\n";

        foreach ($orderItems as $item) {
            $subtotalFormatted = number_format($item['subtotal'], 0, ',', '.');
            $priceFormatted = number_format($item['price'], 0, ',', '.');
            $message .= "- {$item['menu_name']} ({$item['qty']}x @Rp{$priceFormatted}) = Rp{$subtotalFormatted}\n";
        }

        $totalFormatted = number_format($totalPrice, 0, ',', '.');
        $message .= "\n*Total:* Rp{$totalFormatted}\n";

        if ($order->note) {
            $message .= "*Catatan:* {$order->note}\n";
        }

        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }

    /**
     * Show order success page.
     */
    public function success($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        return view('order::success', compact('order'));
    }
}