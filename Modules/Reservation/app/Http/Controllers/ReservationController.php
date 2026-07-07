<?php

namespace Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Show the reservation form.
     */
    public function create()
    {
        $cart = \Modules\Cart\Models\Cart::getCurrent()->load('items.menu');
        return view('reservation::create', compact('cart'));
    }

    /**
     * Store a new reservation, optionally create pre-order from cart, and redirect to WhatsApp.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:20', 'regex:/^(08|\+62)[0-9]+$/'],
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count' => 'required|integer|min:1|max:20',
            'note' => 'nullable|string|max:1000',
        ]);

        $reservation = Reservation::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'guest_count' => $validated['guest_count'],
            'note' => $validated['note'] ?? null,
            'status' => 'pending',
        ]);

        // Build WhatsApp message — reservasi
        $whatsappNumber = config('services.whatsapp.number');
        $message = "*Fujiyama Ramen — Reservasi Meja*\n\n";
        $message .= "*Nama:* {$reservation->name}\n";
        $message .= "*No HP:* {$reservation->phone}\n";
        $message .= "*Tanggal:* " . \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') . "\n";
        $message .= "*Jam:* {$reservation->reservation_time}\n";
        $message .= "*Jumlah Orang:* {$reservation->guest_count}\n";
        if ($reservation->note) {
            $message .= "*Catatan:* {$reservation->note}\n";
        }

        // Cek cart — jika ada isi, buat pre-order
        $cart = \Modules\Cart\Models\Cart::getCurrent()->load('items.menu');
        if ($cart->items->isNotEmpty()) {
            $totalPrice = 0;
            $orderItems = [];

            foreach ($cart->items as $cartItem) {
                $subtotal = $cartItem->menu->price * $cartItem->qty;
                $totalPrice += $subtotal;
                $orderItems[] = new \Modules\Order\Models\OrderItem([
                    'menu_id' => $cartItem->menu_id,
                    'menu_name' => $cartItem->menu->name,
                    'price' => $cartItem->menu->price,
                    'qty' => $cartItem->qty,
                    'subtotal' => $subtotal,
                ]);
            }

            $order = \Modules\Order\Models\Order::create([
                'user_id' => auth()->id(),
                'order_code' => \Modules\Order\Models\Order::generateOrderCode(),
                'customer_name' => $validated['name'],
                'customer_phone' => $validated['phone'],
                'status' => 'pending',
                'total_price' => $totalPrice,
                'payment_method' => null,
                'note' => 'Pre-order dari reservasi #' . $reservation->id,
                'reservation_id' => $reservation->id,
            ]);

            $order->items()->saveMany($orderItems);

            // Hapus isi cart
            $cart->items()->delete();

            // Tambahkan detail pre-order ke pesan WhatsApp
            $message .= "\n═══════════════════\n";
            $message .= "*Pre-Order Menu:*\n";
            foreach ($order->items as $item) {
                $message .= "- {$item->menu_name} ({$item->qty}x) — Rp " . number_format($item->subtotal, 0, ',', '.') . "\n";
            }
            $message .= "*Total Pre-Order:* Rp " . number_format($order->total_price, 0, ',', '.') . "\n";
            $message .= "*Kode Pesanan:* {$order->order_code}\n";
        }

        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
