<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations.
     */
    public function index()
    {
        $reservations = Reservation::orderBy('reservation_date', 'desc')->paginate(15);
        return view('admin::reservations.index', compact('reservations'));
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        return view('admin::reservations.show', compact('reservation'));
    }

    /**
     * Update reservation status.
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $validated['status']]);

        return redirect()->route('admin.reservations.index')->with('success', 'Status reservasi berhasil diperbarui.');
    }
}