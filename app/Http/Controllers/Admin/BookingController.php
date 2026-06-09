<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
                'user',
                'schedule.movie',
                'schedule.studio.cinema',
                'payment',
                'tickets.seat',
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function markPaid(Booking $booking)
    {
        // Ubah status booking
        $booking->status = 'paid';
        $booking->save();

        // Kalau ada payment, update juga
        if ($booking->payment) {
            $booking->payment->status  = 'paid';  // sesuai enum di migration
            $booking->payment->paid_at = now();
            $booking->payment->save();
        }

        return back()->with(
            'success',
            'Status booking #' . $booking->booking_code . ' berhasil diubah menjadi LUNAS.'
        );
    }
}
